<?php
/**
 * Project: CGI Magento Trainee
 *
 * Update Price massaction
 *
 * @category    Cgi
 * @package     Cgi_Updateprice
 * @author      Evi
 * email:       efremova.vasilina@mail.ru
 */
class Cgi_Updateprice_Model_Observer
{
    /**
     * @param Varien_Event_Observer $observer
     */
    public function addMassUpdatePrice(Varien_Event_Observer $observer)
    {
        $block = $observer->getEvent()->getBlock();
        // Check if this block is a MassAction block
        if ($block instanceof Mage_Adminhtml_Block_Widget_Grid_Massaction) {
            // Check if we're dealing with the Orders grid
            if ($block->getParentBlock() instanceof Mage_Adminhtml_Block_Catalog_Product_Grid) {
                // The first parameter has to be unique, or you'll overwrite the old action.

                $source     = Mage::getModel('updateprice/source');
                $operations = array(
                    $source::ADD_PRICE =>'+ n',
                    $source::DEDUCTED_PRICE =>'− n',
                    $source::INCREASE_PERCENTAGE_PRICE =>'+ n%',
                    $source::DEDUCT_PERCENTAGE_PRICE =>'− n%',
                    $source::INCREASE_PRICE =>'* n');

                $block->addItem('updateprice', array(
                    'label'=> Mage::helper('catalog')->__('Update Price'),
                    'url'  => $block->getUrl('*/index/massUpdatePrice', array('_current' => true)),
                    'additional' => array(
                        'operations' => array(
                            'name' => 'operations',
                            'type' => 'select',
                            'class' => 'required-entry',
                            'label' => Mage::helper('catalog')->__('Operations'),
                            'values' => $operations
                        ),
                        'amount' => array(
                            'name' => 'amount',
                            'type' => 'text',
                            'class' => 'required-entry',
                            'label' => Mage::helper('catalog')->__('Amount'),
                        )
                    )
                ));
            }
        }
    }
}