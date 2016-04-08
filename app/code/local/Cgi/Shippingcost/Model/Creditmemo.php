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
class Cgi_Shippingcost_Model_Creditmemo
    extends Mage_Sales_Model_Order_Creditmemo_Total_Abstract
{
    /**
     * @return string
     */
    public function getLabel()
    {
        return Mage::helper('shippingcost')->__('Total Shipping Cost');
    }

    /**
     * @param Mage_Sales_Model_Order_Creditmemo $address
     *
     * @return $this
     */
    public function collect(Mage_Sales_Model_Order_Creditmemo $address)
    {
        parent::collect($address);
        if (($address->getAddressType() == 'billing')) {
            return $this;
        }

        $order = $address->getOrder();
        $amount = $order->getData('total_shippingcost_amount');

        if (is_numeric($amount) && $amount != 0) {
            $this->_addAmount($amount);
            $this->_addBaseAmount($amount);
            $address->setGrandTotal($address->getGrandTotal()+$amount);
            $address->setBaseGrandTotal($address->getBaseGrandTotal()+$amount);
        }

        return $this;
    }

    /**
     * @param $amount
     *
     * @return $this
     */
    protected function _addAmount($amount)
    {
        if ($this->_canAddAmountToAddress) {
            $this->_getAddress()
                ->addTotalAmount('total_shippingcost_amount',$amount);
        }
        return $this;
    }

    /**
     * @param $baseAmount
     *
     * @return $this
     */
    protected function _addBaseAmount($baseAmount)
    {
        if ($this->_canAddAmountToAddress) {
            $this->_getAddress()
                ->addBaseTotalAmount('total_shippingcost_amount', $baseAmount);
        }
        return $this;
    }

    /**
     * @param Mage_Sales_Model_Order_Creditmemo $address
     *
     * @return $this
     */
    public function fetch(Mage_Sales_Model_Order_Creditmemo $address)
    {
        if (($address->getAddressType() == 'billing')) {

            $order = $address->getOrder();
            $amount = $order->getData('total_shippingcost_amount');

            if (is_numeric($amount) && $amount != 0) {
                $address->addTotal(array(
                    'code'  => 'total_shippingcost_amount',
                    'title' => $this->getLabel(),
                    'value' => $amount
                ));
            }
        }

        return $this;
    }
}