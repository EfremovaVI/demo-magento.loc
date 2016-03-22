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
class Cgi_Shippingcost_Model_Shippingcost extends Mage_Core_Block_Template
{
    /**
     * @return $this
     */
    public function initTotals()
    {

        $amount = $this->getParentBlock()->getSource()
            ->getTotalShippingcostAmount();

        if ($amount == null) {
            return $this;
        }

        $this->getParentBlock()->addTotal(
            new Varien_Object(
                array(
                    'code'  => 'total_shippingcost_amount',
                    'value' => $amount,
                    'label' => 'Shipping cost',
                )
            )
            , 'shipping'
        );
        return $this;
    }
}