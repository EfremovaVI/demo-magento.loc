<?php
/**
 * Project: CGI Magento Trainee
 *
 * Top Product Grid
 *
 * @category    Cgi
 * @package     Cgi_Istop
 * @author      Evi
 * email:       efremova.vasilina@mail.ru
 */
class Cgi_Istop_Model_Observer
{
    /**
     * Adds column to admin customers grid
     *
     * @param Varien_Event_Observer $observer
     *
     * @return Cgi_Istop_Model_Observer
     */
    public function addIsTopAttributeToProductGrid(Varien_Event_Observer $observer)
    {
        $block = $observer->getEvent()->getBlock();
        if( ($block instanceof Mage_Adminhtml_Block_Catalog_Product_Grid)) {
            $options = array('1' => 'Yes', '0' => 'No');
            $block->addColumnAfter('is_top', array(
                'header'	=> 'Is Top',
                'index'		=> 'is_top',
                'sortable'	=> true,
                'width'     => '50px',
                'type'      => 'options',
                'options'	=> $options,
            ),'qty');
        }
    }

    /**
     * @param Varien_Event_Observer $observer
     */
    public function beforeCollectionLoad(Varien_Event_Observer $observer)
    {
        $collection = $observer->getEvent()->getCollection();
        if (!isset($collection)) {
            return;
        }
        $collection->addAttributeToSelect('is_top');
    }

}