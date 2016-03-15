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
// Add group in attribute set
$installer->addAttributeGroup('catalog_product', 'Default', 'Education', 1000);

$attrName = 'additional_shipping_cost';

$attr = Mage::getResourceModel('catalog/eav_attribute')
    ->loadByCode('catalog_product', $attrName);

if (!$attr->getId()) {
    // Add attribute in Education group
    $installer->addAttribute('catalog_product', $attrName, array(
        'group'                     => 'Education',
        'input'                     => 'text',
        'type'                      => 'int',
        'label'                     => 'Shipping Cost',
        'global'                    => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
        'visible'                   => 1,
        'required'                  => 0,
        'visible_on_front'          => true,
        'is_html_allowed_on_front'  => 0,
        'is_configurable'           => 0,
        'searchable'                => 0,
        'filterable'                => 0,
        'comparable'                => 0,
        'unique'                    => false,
        'user_defined'              => false,
        'default'                   => 0,
        'is_user_defined'           => false,
        'used_in_product_listing'   => true
    ));
}

$installer->endSetup();
