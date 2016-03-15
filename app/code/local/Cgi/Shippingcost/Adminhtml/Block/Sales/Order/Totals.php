<?php
class Cgi_Shippingcost_Adminhtml_Block_Sales_Order_Totals
    extends Mage_Adminhtml_Block_Sales_Order_Totals
{
    /**
     * Initialize order totals array
     *
     * @return Mage_Sales_Block_Order_Totals
     */
    protected function _initTotals()
    {
        parent::_initTotals();
        $amount = Mage::helper('shippingcost')->cartShippingCost;
        if ($amount) {
            $this->addTotalBefore(new Varien_Object(array(
                'code'      => 'shippingcost',
                'value'     => $amount,
                'base_value'=> $amount,
                'label'     => 'Shipping cost',
            ), array('shipping', 'tax')));
        }

        return $this;
    }

}