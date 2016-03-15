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
class Cgi_Shippingcost_Model_Observer
{
    public function addScreenToPayPal($observer)
    {
        $paypal_cart = $observer->getPaypalCart();
        if ($paypal_cart && $paypal_cart->getSalesEntity()) {

            $amount = Mage::helper('shippingcost')->cartShippingCost; // !!!!!

            if ($amount) {
                $paypal_cart->addItem('Shipping Cost', 1, $amount, 'shippingcost');
            }
        }

    }


}