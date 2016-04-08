<?php
/**
 * Project: CGI Magento Trainee
 *
 * Update Price massaction
 *
 * @category    Cgi
 * @package     Cgi_Updateprice
 * @author      Evi
 * email:       efremova.vasilina@mail.ru
 */
class Cgi_Updateprice_IndexController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Update the Prices on the Products Grid
     */
    public function massUpdatePriceAction()
    {
        $productIds = (array)$this->getRequest()->getParam('product');
        $operations = (string)$this->getRequest()->getParam('operations');
        $amount     = (int)$this->getRequest()->getParam('amount');

        $action = Mage::getModel('updateprice/action');
        $action->updatePrice($productIds, $operations, $amount);

        $this->_redirectReferer();
    }
}