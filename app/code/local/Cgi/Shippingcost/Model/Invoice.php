<?php
class Cgi_Shippingcost_Model_Invoice
    extends Mage_Sales_Model_Order_Invoice_Total_Abstract
{
    public function collect(Mage_Sales_Model_Order_Invoice $invoice)
    {
        $quote = $invoice->getOrder();
        $amount = $quote->getTotalShippingcostAmount();

        if ($amount) {
            $invoice->setGrandTotal($invoice->getGrandTotal() + $amount);
            $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $amount);
        }

        return $this;
    }
}

