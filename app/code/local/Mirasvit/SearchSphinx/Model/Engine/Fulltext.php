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


class Mirasvit_SearchSphinx_Model_Engine_Fulltext extends Mirasvit_SearchIndex_Model_Engine
{
    public function __construct()
    {

    }

    public function query($query, $store, $index)
    {
        $indexCode  = $index->getCode();
        $primaryKey = $index->getPrimaryKey();
        $attributes = $index->getAttributes();

        return $this->_query($query, $store, $index);
    }

    protected function _query($query, $storeId, $index)
    {
        $connection = $this->_getReadAdapter();
        $table      = $index->getIndexer()->getTableName();
        $pk         = $index->getIndexer()->getPrimaryKey();
        $attributes = $this->_getAttributes($index);


        $select = $connection->select();
        $select->from(array('s' => $table), array($pk));

        $bind            = array();
        $case            = array();
        $like            = array();
        $whereCondition  = '';
        $selectCondition = array();

        $words = $this->_prepareAndSplitQuery($query);

        if (count($words) == 0 || count($attributes) == 0) {
            return array();
        }

        foreach ($words as $keyword) {
            foreach ($attributes as $attr => $weight) {
                $case[$attr][] = $this->getCILike('s.'.$attr, $keyword, array('position' => 'any'));
                $like[$keyword][] = $this->getCILike('s.'.$attr, $keyword, array('position' => 'any'));
            }
        }


        $tmpArr = array();
        foreach ($like as $keyword => $cond) {
            $tmpArr[$keyword] = '(' . join(' OR ', $cond) . ')';
        }

        $searchTemplate = Mage::getStoreConfig('searchsphinx/dev/search_template');
        switch ($searchTemplate) {
            case 'or':
                $whereCondition = '(' . join(' OR ', $tmpArr) . ')';
            break;

            default:
            case 'and':
                $whereCondition = '(' . join(' AND ', $tmpArr) . ')';
            break;
        }


        foreach ($case as $attr => $conds) {
            $cases  = array();
            $weight = intval($attributes[$attr] / count($conds));
            foreach ($conds as $cond) {
                $cases[] = 'CASE WHEN '.$cond.' THEN '.$weight.' ELSE 0 END';
            }
            $selectCondition[$attr] = join(' + ', $cases);
        }

        if ($selectCondition) {
           $when = array();
            foreach ($selectCondition as $attr => $cond) {
                $when[] = $cond;
            }

            $case = implode(' + ', $when);
            $select->columns(array('relevance' => new Zend_Db_Expr('('.$case.')')));
        } else {
            $select->columns(array('relevance' => new Zend_Db_Expr('0')));
        }

        $select->where('s.store_id = ?', (int) $storeId);
        if ($whereCondition != '') {
            $select->where($whereCondition);
        }

        $pairs = $connection->fetchPairs($select);

        return $pairs;
    }

    protected function _prepareAndSplitQuery($query)
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

        $words = Mage::helper('core/string')->splitWords($query, true);
        foreach ($words as $indx => $word) {
            if (!$wildcard) {
                $words[$indx] = ' '.$word.' ';
            }
        }

        return $words;
    }

    /**
     * Retrieve attributes and merge with existing columns
     *
     * @param  Mirasvit_SearchIndex_Model_Index_Abstract $index
     * @return array
     */
    protected function _getAttributes($index)
    {
        $attributes = $index->getAttributes(true);
        $columns    = $this->_getTableColumns($index->getIndexer()->getTableName());

        foreach ($attributes as $attr => $weight) {
            if (!in_array($attr, $columns)) {
                unset($attributes[$attr]);
            }
        }
        foreach ($columns as $column) {
            if (!in_array($column, array($index->getIndexer()->getPrimaryKey(), 'store_id', 'updated'))
                && !isset($attributes[$column])) {
                $attributes[$column] = 0;
            }
        }

        return $attributes;
    }

    public function getCILike($field, $value, $options = array())
    {
        $quotedField = $this->_getReadAdapter()->quoteIdentifier($field);
        return new Zend_Db_Expr($quotedField . ' LIKE "' . $this->escapeLikeValue($value, $options).'"');
    }

    public function escapeLikeValue($value, $options = array())
    {
        $value = addslashes($value);

        $from = array();
        $to = array();
        if (empty($options['allow_symbol_mask'])) {
            $from[] = '_';
            $to[] = '\_';
        }
        if (empty($options['allow_string_mask'])) {
            $from[] = '%';
            $to[] = '\%';
        }
        if ($from) {
            $value = str_replace($from, $to, $value);
        }

        if (isset($options['position'])) {
            switch ($options['position']) {
                case 'any':
                    $value = '%' . $value . '%';
                    break;
                case 'start':
                    $value = $value . '%';
                    break;
                case 'end':
                    $value = '%' . $value;
                    break;
            }
        }

        return $value;
    }

    protected function _getTableColumns($tableName)
    {
        $columns = array_keys($this->_getReadAdapter()->describeTable($tableName));

        return $columns;
    }
}