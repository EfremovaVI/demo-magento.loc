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
    public function _construct()
    {
        $this->setCode('total_shippingcost_amount');
    }

    public function getLabel()
    {
        return Mage::helper('shippingcost')->__('Total Shipping Cost');
    }

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
        }

        return $this;
    }
    protected function _addAmount($amount)
    {
        if ($this->_canAddAmountToAddress) {
            $this->_getAddress()->addTotalAmount($this->getCode(),$amount);
        }
        return $this;
    }

    protected function _addBaseAmount($baseAmount)
    {
        if ($this->_canAddAmountToAddress) {
            $this->_getAddress()->addBaseTotalAmount($this->getCode(), $baseAmount);
        }
        return $this;
    }

    public function fetch(Mage_Sales_Model_Order_Creditmemo $address)
    {
        if (($address->getAddressType() == 'billing')) {

            $order = $address->getOrder();
            $amount = $order->getData('total_shippingcost_amount');

            if (is_numeric($amount) && $amount != 0) {
                $address->addTotal(array(
                    'code'  => $this->getCode(),
                    'title' => $this->getLabel(),
                    'value' => $amount
                ));
            }
        }

        return $this;
    }
}