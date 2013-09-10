<?php

/* @var $installer Mageist_Sanalpos_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
$table = $installer->getConnection()->newTable($installer->getTable('sanalpos/gateway'))
        ->setComment('Mageist Sanalpos Gateway Table')
        ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'unsigned' => true,
            'nullable' => false,
            'primary' => true,
            'identity' => true,
                ), 'Gateway ID')
        ->addColumn('gateway_type', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Gateway Type')
        ->addColumn('gateway_code', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Gateway Code')
        ->addColumn('gateway_name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Gateway Name')
        ->addColumn('gateway_title', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Gateway Title')
        ->addColumn('gateway_image', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Gateway Image')
        ->addColumn('gateway_icon', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Gateway Icon')
        ->addColumn('gateway_color_dark', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Gateway Background Color - Dark')
        ->addColumn('gateway_color_light', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Gateway Background Color - Light')
        ->addColumn('gateway_color_text', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Gateway Text Color')
        ->addColumn('top_text', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
            'nullable' => true,
            'default' => null,
                ), 'Gateway Table - Top Text')
        ->addColumn('bottom_text', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
            'nullable' => true,
            'default' => null,
                ), 'Gateway Table - Bottom Text')
        ->addColumn('is_active_gateway', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
            'unsigned' => true,
            'nullable' => false,
            'default' => '0',
                ), 'Is Active Gateway')
        ->addColumn('test_mode', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
            'unsigned' => true,
            'nullable' => false,
            'default' => '0',
                ), 'Test Mode')
        ->addColumn('store_no', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Store No')
        ->addColumn('terminal_no', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Terminal No')
        ->addColumn('posnet_id', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Posnet Id')
        ->addColumn('security_code', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Security Code')
        ->addColumn('username', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Username')
        ->addColumn('api_username', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Api Username')
        ->addColumn('api_password', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Api Password')
        ->addColumn('three_d_store_key', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), '3D Store Key')
        ->addColumn('three_d_store_type', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), '3D Store Type')
        ->addColumn('gateway_api_url', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Api URL')
        ->addColumn('gateway_redirect_url', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Redirect Url')
        ->addColumn('store_no_test', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Test Store No')
        ->addColumn('terminal_no_test', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Test Terminal No')
        ->addColumn('posnet_id_test', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Test Posnet Id')
        ->addColumn('security_code_test', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Test Security Code')
        ->addColumn('username_test', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Test Username')
        ->addColumn('api_username_test', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Test Api Username')
        ->addColumn('api_password_test', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Test Api Password')
        ->addColumn('three_d_store_key_test', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Test 3D Store Key')
        ->addColumn('three_d_store_type_test', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Test 3D Store Type')
        ->addColumn('cc_number_test', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Test CC Number')
        ->addColumn('cc_cvv_test', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Test CVV')
        ->addColumn('cc_exp_month_test', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Test Exp Month')
        ->addColumn('cc_exp_year_test', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Test Exp Year')
        ->addColumn('gateway_api_url_test', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Test Api URL')
        ->addColumn('gateway_redirect_url_test', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Test Gateway URL')
        ->addColumn('gateway_panel_url_test_login', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Test Panel Login')
        ->addColumn('gateway_panel_url_test_pass', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Test Panel Password')
        ->addColumn('gateway_panel_url_test_parole', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Test Panel Parole')
        ->addColumn('gateway_panel_url', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Panel URL')
        ->addColumn('gateway_panel_url_test', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Test Panel URL')
        ->addColumn('supported_currency_list', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Supported Currencies')
        ->addColumn('currency', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Selected Currency')
        ->addColumn('payment_method', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Payment Method')
        ->addColumn('successful_order_status', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Successful Order Status')
        ->addColumn('notification_email', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Notification Email')
        ->addColumn('bin_numbers', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
            'nullable' => true,
            'default' => null,
                ), 'BIN Numbers')
        ->addColumn('sort_order', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
            'unsigned' => true,
            'nullable' => false,
            'default' => '0',
                ), 'Sort Order')
        ->addColumn('is_installment_active', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
            'unsigned' => true,
            'nullable' => false,
            'default' => '0',
                ), 'Is Installment Active')
        ->addColumn('installment_0_value', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
            'nullable' => true,
            'default' => null,
                ), 'Installment 0')
        ->addColumn('installment_1_value', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
            'nullable' => true,
            'default' => null,
                ), 'Installment 1')
        ->addColumn('installment_2_value', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
            'nullable' => true,
            'default' => null,
                ), 'Installment 2')
        ->addColumn('installment_3_value', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
            'nullable' => true,
            'default' => null,
                ), 'Installment 3')
        ->addColumn('installment_4_value', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
            'nullable' => true,
            'default' => null,
                ), 'Installment 4')
        ->addColumn('installment_5_value', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
            'nullable' => true,
            'default' => null,
                ), 'Installment 5')
        ->addColumn('installment_6_value', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
            'nullable' => true,
            'default' => null,
                ), 'Installment 6')
        ->addColumn('installment_7_value', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
            'nullable' => true,
            'default' => null,
                ), 'Installment 7')
        ->addColumn('installment_8_value', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
            'nullable' => true,
            'default' => null,
                ), 'Installment 8')
        ->addColumn('installment_9_value', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
            'nullable' => true,
            'default' => null,
                ), 'Installment 9')
        ->addColumn('installment_10_value', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
            'nullable' => true,
            'default' => null,
                ), 'Installment 10')
        ->addColumn('installment_11_value', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
            'nullable' => true,
            'default' => null,
                ), 'Installment 11')
        ->addColumn('installment_12_value', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
            'nullable' => true,
            'default' => null,
                ), 'Installment 12')
        ->addColumn('installment_13_value', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
            'nullable' => true,
            'default' => null,
                ), 'Installment 13')
        ->addColumn('installment_14_value', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
            'nullable' => true,
            'default' => null,
                ), 'Installment 14')
        ->addColumn('installment_15_value', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
            'nullable' => true,
            'default' => null,
                ), 'Installment 15')
        ->addColumn('installment_16_value', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
            'nullable' => true,
            'default' => null,
                ), 'Installment 16')
        ->addColumn('installment_17_value', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
            'nullable' => true,
            'default' => null,
                ), 'Installment 17')
        ->addColumn('installment_18_value', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
            'nullable' => true,
            'default' => null,
                ), 'Installment 18')
        ->addColumn('installment_19_value', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
            'nullable' => true,
            'default' => null,
                ), 'Installment 19')
        ->addColumn('installment_20_value', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
            'nullable' => true,
            'default' => null,
                ), 'Installment 20')
        ->addColumn('installment_21_value', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
            'nullable' => true,
            'default' => null,
                ), 'Installment 21')
        ->addColumn('installment_22_value', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
            'nullable' => true,
            'default' => null,
                ), 'Installment 22')
        ->addColumn('installment_23_value', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
            'nullable' => true,
            'default' => null,
                ), 'Installment 23')
        ->addColumn('installment_24_value', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
            'nullable' => true,
            'default' => null,
        ), 'Installment 24');


$installer->getConnection()->createTable($table);


$table = $installer->getConnection()->newTable($installer->getTable('sanalpos/logger'))
        ->setComment('Mageist Sanalpos Log Table')
        ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'unsigned' => true,
            'nullable' => false,
            'primary' => true,
            'identity' => true,
                ), 'ID')
        ->addColumn('gateway_type', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Gateway Type')
        ->addColumn('gateway_code', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Gateway Code')
        ->addColumn('gateway_name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Gateway Name')
        ->addColumn('status', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
            'unsigned' => true,
            'nullable' => false,
            'default' => '0',
                ), 'Status')
        ->addColumn('real_order_id', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Real Order ID')
        ->addColumn('order_id', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Order ID')
        ->addColumn('amount', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
            'nullable' => true,
            'default' => null,
        ), 'Amount')
        ->addColumn('currency', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Currency')
        ->addColumn('api_request', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
            'nullable' => true,
            'default' => null,
                ), 'Api Request')
        ->addColumn('api_result', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
            'nullable' => true,
            'default' => null,
                ), 'Api Result')
        ->addColumn('threed_request', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
            'nullable' => true,
            'default' => null,
                ), '3D Request')
        ->addColumn('threed_result', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
            'nullable' => true,
            'default' => null,
                ), '3D Result')
        ->addColumn('message', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Result Message')
        ->addColumn('ip_address', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'IP Address')
        ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true,
            'default' => null,
                ), 'Customer ID')
        ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(), 'Created at');

$installer->getConnection()->createTable($table);

$installer->endSetup();