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
    /***
     * Change the Shipping Cost Total Quote
     *
     * @param Varien_Event_Observer $observer
     * @event sales_quote_item_set_product
     *
     * @return $this
     */
    public function saveQuoteShippingCostAmount(Varien_Event_Observer $observer)
    {
        $quote = $observer->getEvent()->getQuoteItem()->getQuote();

        $totalShippingcostAmount = Mage::getModel('shippingcost/quote');
        $amount = $totalShippingcostAmount->getTotalShippingcostAmount(
            $quote->getAllItems()
        );

        if ($amount) {
            $quote->setData(
                'total_shippingcost_amount', $amount
            );
        }
    }
}