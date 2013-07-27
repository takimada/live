<?php
/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at http://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   Sphinx Search Ultimate
 * @version   2.2.8
 * @revision  277
 * @copyright Copyright (C) 2013 Mirasvit (http://mirasvit.com/)
 */



if (!@class_exists('SphinxClient')) {
    $dir = Mage::getModuleDir('', 'Mirasvit_SearchSphinx').DS.'Model';
    include $dir.DS.'sphinxapi.php';
}

class Mirasvit_SearchSphinx_Model_Engine_Sphinx extends Mirasvit_SearchIndex_Model_Engine
{
    const SEARCHD                   = 'searchd';
    const INDEXER                   = 'indexer';
    const REINDEX_SUCCESS_MESSAGE   = 'rotating indices: succesfully sent SIGHUP to searchd';
    const PAGE_SIZE                 = 1000;
    const MAX_MATCHES               = 50000;

    protected $_configFilepath      = null;
    protected $_synonymsFilepath    = null;
    protected $_stopwordsFilepath   = null;
    protected $_indexerCommand      = null;
    protected $_searchdCommand      = null;
    protected $_sphinxCfgTpl        = null;
    protected $_sphinxSectionCfgTpl = null;

    protected $_spxHost             = null;
    protected $_spxPort             = null;

    protected $_matchMode           = null;

    public function __construct()
    {
        $binPath = Mage::getStoreConfig('searchsphinx/advanced/bin_path');

        $this->_configFilepath      = Mage::getBaseDir('var').'/sphinx/sphinx.conf';
        $this->_synonymsFilepath    = Mage::getBaseDir('var').'/sphinx/synonyms.txt';
        $this->_stopwordsFilepath   = Mage::getBaseDir('var').'/sphinx/stopwords.txt';

        $this->_indexerCommand      = $binPath.self::INDEXER;
        $this->_searchdCommand      = $binPath.self::SEARCHD;
        $this->_sphinxCfgTpl        = Mage::getModuleDir('etc', 'Mirasvit_SearchSphinx').DS.'conf'.DS.'sphinx.conf';
        $this->_sphinxSectionCfgTpl = Mage::getModuleDir('etc', 'Mirasvit_SearchSphinx').DS.'conf'.DS.'section.conf';

        $this->_spxHost             = Mage::getStoreConfig('searchsphinx/advanced/host');
        $this->_spxPort             = Mage::getStoreConfig('searchsphinx/advanced/port');

        $this->_spxHost             = $this->_spxHost ? $this->_spxHost : 'localhost';
        $this->_spxPort             = intval($this->_spxPort ? $this->_spxPort : '9315');

        $this->_matchMode           = Mage::getStoreConfig('searchsphinx/advanced/match_mode', 0);
    }

    public function query($queryText, $store, $index)
    {
        $indexCode  = $index->getCode();
        $primaryKey = $index->getPrimaryKey();
        $attributes = $index->getAttributes();

        if ($store) {
            $store = array($store);
        }

        return $this->_query($queryText, $store, $indexCode, $primaryKey, $attributes);
    }

    protected function _query($query, $storeId, $indexCode, $entityKey, $attributes, $offset = 1)
    {
        $client = new SphinxClient();
        $client->setMaxQueryTime(30);
        $client->setLimits(($offset - 1) * self::PAGE_SIZE, self::PAGE_SIZE, 100000);
        $client->setSortMode(SPH_SORT_RELEVANCE);
        $client->setMatchMode($this->_matchMode);
        $client->setServer($this->_spxHost, $this->_spxPort);
        $client->SetFieldWeights($attributes);
        if ($storeId) {
            $client->SetFilter('store_id', $storeId);
        }

        $correctQuery = $this->_correctQuery($query);
        if (!$correctQuery) {
            return array();
        }

        $result = $client->query($correctQuery, $indexCode);

        if ($result === false) {
            Mage::throwException($client->GetLastError()."\nQuery: ".$query);
        } elseif ($result['total'] > 0) {
            $entityIds = array();
            foreach ($result['matches'] as $data) {
                $entityIds[$data['attrs'][$entityKey]] = $data['weight'];
            }

            if ($result['total'] > $offset * self::PAGE_SIZE
                && $offset * self::PAGE_SIZE < self::MAX_MATCHES) {
                $newIds = $this->_query($query, $storeId, $indexCode, $entityKey, $attributes, $offset + 1);
                foreach ($newIds as $key => $value) {
                   $entityIds[$key] = $value;
                }
            }
        } else {
            $entityIds = array();
        }

        return $entityIds;
    }

    /**
     * @param  string $query
     * @return string
     */
    protected function _correctQuery($query)
    {
        if ($this->_matchMode != SPH_MATCH_EXTENDED) {
            return $query;
        }

        // Extended query syntax
        if (substr($query, 0, 1) == '=') {
            return substr($query, 1);
        }

        if (substr($query, 0, 1) == '@') {
            return $query;
        }

        $query     = ' '.$query.' ';
        $stopwords = unserialize(Mage::getStoreConfig('searchsphinx/advanced/stopwords'));
        foreach ($stopwords as $value) {
            $word  = trim($value['stopword']);
            $query = str_replace(' '.$word.' ', '', $query);
        }

        $result = '';
        $keywords = array();
        $keywords = $this->_getSphinxKeyword($query);

        $searchTemplate = Mage::getStoreConfig('searchsphinx/dev/search_template');
        switch ($searchTemplate) {
            case 'and':
                $result = implode(' & ', $keywords);
            break;

            case 'or':
                $result = implode(' | ', $keywords);
            break;

            case 'quorum':
                $quorum = intval(Mage::getStoreConfig('searchsphinx/dev/quorum'));
                $quorum = ceil(count($keywords) /  100 * $quorum);
                $query = addslashes($query);
                $result = '"'.$query.'" / '.$quorum;
            break;
        }

        return $result;
    }

    /**
     * @param  string $sQuery
     * @return string
     */
    protected function _getSphinxKeyword($query)
    {
        $wildcard = Mage::getStoreConfig('searchsphinx/dev/wildcard');
        $synonyms = unserialize(Mage::getStoreConfig('searchsphinx/advanced/synonyms'));
        $query = strtolower($query);
        foreach ($synonyms as $data) {
            $to = strtolower($data['word']);
            foreach (explode(',', $data['synonyms']) as $syn) {

                $syn = strtolower(trim($syn));
                $query = str_replace($syn, $to, $query);
            }
        }

        $aRequestString = preg_split('/[\s,-]+/', $query, 5);
        $wildcard = Mage::getStoreConfig('searchsphinx/dev/wildcard');
        if ($aRequestString) {
            $aKeyword = array();
            foreach ($aRequestString as $sValue) {
                if (strlen(trim($sValue)) >= 1) {
                    if ($wildcard) {
                        $aKeyword[] .= "(".$sValue." | *".$sValue."*)";
                    } else {
                        $aKeyword[] .= "(".$sValue.")";
                    }
                }
            }
        }
        return $aKeyword;
    }

    public function makeConfigFile()
    {
        if (!file_exists(Mage::getBaseDir('var').DS.'sphinx')) {
            mkdir(Mage::getBaseDir('var').DS.'sphinx');
        }

        $data = array(
            'time'      => date('d.m.Y H:i:s'),
            'host'      => $this->_spxHost,
            'port'      => $this->_spxPort,
            'logdir'    => Mage::getBaseDir('var').DS.'sphinx',
            'sphinxdir' => Mage::getBaseDir('var').DS.'sphinx',
        );

        $formater = new Varien_Filter_Template();
        $formater->setVariables($data);
        $config   = $formater->filter(file_get_contents($this->_sphinxCfgTpl));

        $indexes = Mage::helper('searchindex/index')->getIndexes();
        foreach ($indexes as $index) {
            $indexer = $index->getIndexer();
            $config  .= "\n".$this->_getSectionConfig($index->getCode(), $indexer);
        }

        file_put_contents($this->_configFilepath, $config);

        $this->_makeSynonymsFile();
        $this->_makeStopwordsFile();

        return $this;
    }

    /**
     * @todo mode to .conf template file
     */
    protected function _getSectionConfig($name, $indexer)
    {
        $data = array(
            'name'             => $name,
            'sql_host'         => Mage::getConfig()->getNode('global/resources/default_setup/connection/host'),
            'sql_user'         => Mage::getConfig()->getNode('global/resources/default_setup/connection/username'),
            'sql_pass'         => Mage::getConfig()->getNode('global/resources/default_setup/connection/password'),
            'sql_db'           => Mage::getConfig()->getNode('global/resources/default_setup/connection/dbname'),
            'sql_query_pre'    => $this->_getSqlQueryPre($indexer),
            'sql_query'        => $this->_getSqlQuery($indexer),
            'sql_query_delta'  => $this->_getSqlQueryDelta($indexer),
            'sql_attr_uint'    => $indexer->getPrimaryKey(),
            'stopwords'        => Mage::getBaseDir('var').DS.'sphinx'.DS.'stopwords.txt',
            'exceptions'       => Mage::getBaseDir('var').DS.'sphinx'.DS.'synonyms.txt',
            'index_path'       => Mage::getBaseDir('var').DS.'sphinx'.DS.$name,
            'delta_index_path' => Mage::getBaseDir('var').DS.'delta',
        );

        foreach ($data as $key => $value) {
            $data[$key] = str_replace('#', '\#', $value);
        }

        $formater = new Varien_Filter_Template();
        $formater->setVariables($data);
        $config   = $formater->filter(file_get_contents($this->_sphinxSectionCfgTpl));

        return $config;
    }

    protected function _makeStopwordsFile()
    {
        $stopwords = unserialize(Mage::getStoreConfig('searchsphinx/advanced/stopwords'));
        $tofile    = array();
        foreach ($stopwords as $value) {
            $word          = trim($value['stopword']);
            $tofile[$word] = $word;
        }

        ksort($tofile);
        file_put_contents($this->_stopwordsFilepath, implode("\n", $tofile));
    }

    protected function _makeSynonymsFile()
    {
        $synonyms = unserialize(Mage::getStoreConfig('searchsphinx/advanced/synonyms'));
        $tofile   = array('word => synonym');

        foreach ($synonyms as $value) {
            $base    = $value['word'];
            $words   = explode(',', $value['synonyms']);
            $words[] = $base;

            foreach ($words as $a) {
                foreach ($words as $b) {
                    $a = trim($a);
                    $b = trim($b);
                    if ($a && $b && $a != $b) {
                        $tofile[$a.$b] = $a.' => '.$b;
                        $tofile[$b.$a] = $b.' => '.$a;
                    }
                }
            }
        }

        ksort($tofile);
        file_put_contents($this->_synonymsFilepath, implode("\n", $tofile));
    }

    public function reindex($delta = false)
    {
        $this->makeConfigFile();

        if (!$this->isIndexerFounded()) {
            Mage::throwException($this->_indexerCommand.': command not found');
        }

        if (!$this->isIndexerRunning()) {
            if ($delta) {
                $index = 'delta';
            }

            $indexes = Mage::helper('searchindex/index')->getIndexes();
            foreach ($indexes as $index) {
                $exec   = $this->_exec($this->_indexerCommand.' --config '.$this ->_configFilepath.' --rotate '.$index->getCode());
                $result = ($exec['status'] == 0) || (strpos($exec['data'], self::REINDEX_SUCCESS_MESSAGE) !== FALSE);

                if (!$result) {
                    Mage::throwException('Error on reindex '.$exec['data']);
                }
            }
            $this->restart();
        } else {
            Mage::throwException('Reindex already run, please wait... '.$this->isIndexerRunning());
        }

        return $this;
    }

    public function start()
    {
        $this->stop();
        if (!$this->isSearchdFounded()) {
            Mage::throwException($this->_searchdCommand.': command not found');
        }

        $this->makeConfigFile();

        $command = $this->_searchdCommand.' --config '.$this->_configFilepath;
        $exec = $this->_exec($command);
        if ($exec['status'] !== 0) {
            Mage::throwException('Error when running searchd '.$exec['data']);
        }

        return $this;
    }

    public function stop()
    {
        $command = '/usr/bin/killall -9 '.self::SEARCHD;
        $exec = $this->_exec($command);

        return $this;
    }

    public function restart()
    {
        $this->makeConfigFile();

        $this->stop();
        $this->start();

        return $this;
    }

    public function isIndexerRunning()
    {
        $status = false;

        $command = 'ps aux | grep '.self::INDEXER.' | grep '.$this->_configFilepath;
        $exec = $this->_exec($command);
        if ($exec['status'] === 0) {
            $pos = strpos($exec['data'], '--rotate');
            if ($pos !== false) {
                $status = $exec['data'];
                break;
            }
        }

        return $status;
    }

    public function isSearchdRunning()
    {
        if (!$this->isSearchdFounded()) {
            return false;
        }

        $command = 'ps aux | grep '.self::SEARCHD.' | grep '.$this->_configFilepath;
        $exec = $this->_exec($command);

        if ($exec['status'] === 0) {
            $pos = strpos($exec['data'], self::SEARCHD.' --config');

            if ($pos !== false) {
                return true;
            }
        }

        return false;
    }

    public function isSearchdFounded()
    {
        $exec = $this->_exec('which '.$this->_searchdCommand);
        if ($exec['status'] !== 0) {
            return false;
        }

        return true;
    }

    public function isIndexerFounded()
    {
        $exec = $this->_exec('which '.$this->_indexerCommand);
        if ($exec['status'] !== 0) {
            return false;
        }

        return true;
    }

    public function reindexDelta()
    {
        return $this->reindex(true);
    }

    public function mergeDeltaWithMain()
    {
        $output = array();
        @exec($this->_indexerCommand.' --config '.$this ->_configFilepath.' --merge '.$this->_spxIndex.' delta --merge-dst-range deleted 0 0 --rotate', $output, $error);
    }

    protected function _exec($command)
    {
        $status = null;
        $data   = array();
        exec($command, $data, $status);

        return array('status' => $status, 'data' => implode("\n", $data));
    }

    protected function _getSqlQueryPre($indexer)
    {
        $table = $indexer->getTableName();

        $sql = 'UPDATE '.$table.' SET updated=0';

        return $sql;
    }

    protected function _getSqlQuery($indexer)
    {
        $table = $indexer->getTableName();

        $sql = 'SELECT CONCAT('.$indexer->getPrimaryKey().', store_id) AS id, '.$table.'.* FROM '.$table;

        return $sql;
    }

    protected function _getSqlQueryDelta($indexer)
    {
        $sql = $this->_getSqlQuery($indexer);
        $sql .= ' WHERE updated = 1';

        return $sql;
    }
}