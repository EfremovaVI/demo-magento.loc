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
class Cgi_Shippingcost_Model_Quote
    extends Mage_Sales_Model_Quote_Address_Total_Abstract
{
    public function _construct()
    {
        $this->setCode('total_shippingcost_amount');
    }

    public function getLabel()
    {
        return 'Total Shipping Cost';
    }

    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        parent::collect($address);
        if (($address->getAddressType() == 'billing')) {
            return $this;
        }
        $quote = $address->getQuote();
        $amount = $quote->getData('total_shippingcost_amount');

        if (is_numeric($amount) && $amount != 0) {
            $this->_addAmount($amount);
            $this->_addBaseAmount($amount);
        }

        return $this;
    }

    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
        if (($address->getAddressType() == 'billing')) {

            $quote = $address->getQuote();
            $amount = $quote->getData('total_shippingcost_amount');

            if (is_numeric($amount) && $amount != 0) {
                $address->addTotal(
                    array(
                        'code'  => $this->getCode(),
                        'title' => $this->getLabel(),
                        'value' => $amount
                    )
                );
            }
        }

        return $this;
    }
}