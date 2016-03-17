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
class Cgi_Shippingcost_Block_Adminhtml_Sales_Order_Totals
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

        $amount = $this->getSource()->getTotalShippingcostAmount();

        if ($amount) {
            $this->addTotalBefore(new Varien_Object(array(
                'code'      => 'total_shippingcost_amount',
                'value'     => $amount,
                'base_value'=> $amount,
                'label'     => 'Shipping cost',
            ), array('shipping', 'tax')));
        }

        return $this;
    }

}