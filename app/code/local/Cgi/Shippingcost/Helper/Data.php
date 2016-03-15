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
class Cgi_Shippingcost_Helper_Data extends Mage_Core_Helper_Abstract
{
    public $cartShippingCost = null;

    public function getShippingCost($order)
    {

        return $this->cartShippingCost;
    }
}