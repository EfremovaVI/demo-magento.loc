<?php
/**
 * Project: CGI Magento Trainee
 *
 * Additional shipping cost
 *
 * @category    Cgi
 * @package     Cgi_Shippingcost
 * @author      Evi
 * email:       efremova.vasilina@mail.ru
 */

$installer = $this;
$installer->startSetup();

$installer->getConnection()
    ->addColumn($installer->getTable('sales/quote'),
        'total_shippingcost_amount',
        array(
            'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
            'length' => '12,4',
            'nullable'  => true,
            'comment' => 'Total Shipping Cost Amount',
        )
    );

$installer->getConnection()
    ->addColumn($installer->getTable('sales/order'),
        'total_shippingcost_amount',
        array(
            'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
            'length' => '12,4',
            'nullable'  => true,
            'comment' => 'Total Shipping Cost Amount',
        )
    );

//$installer->getConnection()
//    ->addColumn($installer->getTable('sales/quote_address'),
//        'total_shippingcost_amount',
//        array(
//            'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
//            'length' => '12,4',
//            'nullable'  => true,
//            'comment' => 'Total Shipping Cost Amount',
//        )
//    );
//
//$installer->getConnection()
//    ->addColumn($installer->getTable('sales/invoice'),
//        'total_shippingcost_amount',
//        array(
//            'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
//            'length' => '12,4',
//            'nullable'  => true,
//            'comment' => 'Total Shipping Cost Amount',
//        )
//    );
//
//$installer->getConnection()
//    ->addColumn($installer->getTable('sales/creditmemo'),
//        'total_shippingcost_amount',
//        array(
//            'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
//            'length' => '12,4',
//            'nullable'  => true,
//            'comment' => 'Total Shipping Cost Amount',
//        )
//    );



$installer->endSetup();