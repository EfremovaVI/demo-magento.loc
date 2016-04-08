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
class Cgi_Istop_Block_Topproduct extends Mage_Core_Block_Template
    implements Mage_Widget_Block_Interface
{
    public $_collectionTopProducts = array();
    public $_widgetName;

    /**
     * Create Top Products widget
     *
     * @return string
     */
    protected function _toHtml()
    {
        $this->_widgetName = $this->getData('widget_name');

        $storeId = (int)Mage::app()->getStore()->getStoreId();
        $collection = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addStoreFilter($storeId)
            ->addAttributeToFilter('status', Mage_Catalog_Model_Product_Status::STATUS_ENABLED)
            ->addAttributeToFilter('is_top', array('eq' => 1))
            ->addAttributeToSort('created_at', 'DESC')
            ->setPageSize($this->getData('count_product'))
            ->load();
        $collection->getSelect()->order('rand()');

        $this->_collectionTopProducts = $collection;
        return parent::_toHtml();
    }
}