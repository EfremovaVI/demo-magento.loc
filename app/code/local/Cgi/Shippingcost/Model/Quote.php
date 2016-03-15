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

    /**
     * Cgi_Shippingcost_Model_Quote constructor.
     */
    public function __construct()
    {
        $this->setCode('shippingcost');
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return 'Shipping Cost';
    }

    /**
     * Collect totals information about insurance
     *
     * @param   Mage_Sales_Model_Quote_Address $address
     *
     * @return $this|Mage_Sales_Model_Quote_Address_Total_Abstract
     */
    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        parent::collect($address);
        if (($address->getAddressType() == 'billing')) {
            return $this;
        }

        $quote = $address->getQuote();
        $amount = $quote->getData('total_shippingcost_amount');

        if ($amount) {
            $this->_addAmount($amount);
            $this->_addBaseAmount($amount);
        }

        return $this;
    }

    /**
     * Add giftcard totals information to address object
     *
     * @param   Mage_Sales_Model_Quote_Address $address
     *
     * @return $this|array
     */
    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
        if (($address->getAddressType() == 'billing')) {

            $quote = $address->getQuote();
            $amount = $quote->getTotalShippingcostAmount();

            if ($amount != 0) {
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