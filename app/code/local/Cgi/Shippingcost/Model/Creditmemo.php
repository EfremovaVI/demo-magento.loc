<?php
class Cgi_Shippingcost_Model_Creditmemo
    extends Mage_Sales_Model_Order_Creditmemo_Total_Abstract
{
    public function collect(Mage_Sales_Model_Order_Creditmemo $creditmemo)
    {
        $quote = $creditmemo->getOrder();
        $amount = $quote->getTotalShippingcostAmount();

        if ($amount) {
            $creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $amount);
            $creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $amount);
        }

        return $this;
    }
}