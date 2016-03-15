<?php
class Cgi_Shippingcost_Adminhtml_Block_Sales_Order_Creditmemo_Totals
    extends Mage_Adminhtml_Block_Sales_Order_Creditmemo_Totals
{
    /**
     * Initialize order totals array
     *
     * @return Mage_Sales_Block_Order_Totals
     */
    protected function _initTotals()
    {
        parent::_initTotals();

        $amount = $this->getSource()->getTotalShippingcostAmount();

        if ($amount) {
            $this->addTotalBefore(new Varien_Object(array(
                'code'      => 'shippingcost',
                'value'     => $amount,
                'base_value'=> $amount,
                'label'     => 'Shipping Cost',
            ), array('shipping', 'tax')));
        }

        return $this;
    }

}