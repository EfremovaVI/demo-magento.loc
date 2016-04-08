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

/**
 * Add 'total_shippingcost_amount' attribute for entities
 */
$attribute_code = 'total_shippingcost_amount';
$entities = array(
    'quote',
    'order',
);
$options = array(
    'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
    'length' => '12,4',
    'nullable'  => true,
    'comment' => 'Total Shipping Cost Amount',
);

foreach ($entities as $entity) {
    $installer->getConnection()
        ->addColumn(
            $installer->getTable('sales/'.$entity), $attribute_code, $options
        );
}

$installer->endSetup();