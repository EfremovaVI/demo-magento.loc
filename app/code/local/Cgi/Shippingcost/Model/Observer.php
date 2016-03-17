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
     *
     * @return $this
     */
    public function saveQuoteShippingCostAmount(Varien_Event_Observer $observer)
    {
        $quoteItem = $observer->getEvent()->getQuoteItem();
        $quote = $quoteItem->getQuote();

        $TotalShippingcostAmount = null;
        foreach ($quote->getAllItems() as $item) {
            $productData = Mage::getModel('catalog/product')
                ->load($item->getProductId());
            $productTotalShippingcostAmount
                = $productData->getTotalShippingcostAmount();
            $qty = $quote->getItemByProduct($productData)->getQty();
            $TotalShippingcostAmount += $productTotalShippingcostAmount * $qty;
        }

        if ($TotalShippingcostAmount) {
            $quoteItem->setData(
                'total_shippingcost_amount', $TotalShippingcostAmount
            );
            $quote->setData(
                'total_shippingcost_amount', $TotalShippingcostAmount
            );
            $TotalShippingcostAmount = null;
        }

    }

    /***
     * Change the Shipping Cost Total Order
     *
     * @param Varien_Event_Observer $observer
     *
     * @return $this
     */
    public function saveOrderShippingCostAmount(Varien_Event_Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();

        $quoteId = $order->getQuoteId();
        $itemQuote = Mage::getModel('sales/quote')->load($quoteId);

        $TotalShippingcostAmount = $itemQuote->getTotalShippingcostAmount();

        if ($TotalShippingcostAmount) {
            $order->setData(
                'total_shippingcost_amount', $TotalShippingcostAmount
            );
        }

    }
}