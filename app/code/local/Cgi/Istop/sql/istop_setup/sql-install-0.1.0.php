<?php
/**
 * Project: CGI Magento Trainee
 *
 * Top Product Widget
 *
 * @category    Cgi
 * @package     Cgi_Istop
 * @author      Evi
 * email:       efremova.vasilina@mail.ru
 */
$installer = $this;
$installer->startSetup();
// Add group in attribute set
$installer->addAttributeGroup('catalog_product', 'Default', 'Education', 1000);

$attr = Mage::getResourceModel('catalog/eav_attribute')
    ->loadByCode('catalog_product', 'is_top');

if (!$attr->getId()) {
// Add attribute in Education group
    $installer->addAttribute('catalog_product', 'is_top', array(
        'group'                     => 'Education',
        'input'                     => 'select',
        'type'                      => 'int',
        'label'                     => 'Is top',
        'source'                    => 'eav/entity_attribute_source_boolean',
        'global'                    => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
        'visible'                   => 1,
        'required'                  => 0,
        'visible_on_front'          => 0,
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

    $productIds = Mage::getResourceModel('catalog/product_collection')
        ->getAllIds();

    // Now create an array of attribute_code => values
    $attributeData = array('is_top' => 0);

    // Set the store to affect. I used admin to change all default values
    $storeId = (int)Mage::app()->getStore()->getStoreId();

    // Now update the attribute for the given products.
    Mage::getSingleton('catalog/product_action')
        ->updateAttributes($productIds, $attributeData, $storeId);
}

$installer->endSetup();