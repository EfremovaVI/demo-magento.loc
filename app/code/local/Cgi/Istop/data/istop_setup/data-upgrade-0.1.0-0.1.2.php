<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$identifier = 'top_product';
$title = 'Top product';
$content = '{{widget type="istop/topproduct" widget_name="Top product" count_product="3" template="istop/widget.phtml"}}';

Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

$staticBlock = array(
    'title' => $title,
    'identifier' => $identifier,
    'content' => $content,
    'is_active' => 1,
    'stores' => array(0)
);

$block= Mage::getModel('cms/block')->load($staticBlock['identifier']);
if (!$block->getId()) {
    Mage::getModel('cms/block')->setData($staticBlock )->save();
}

$installer->endSetup();