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
        $model      = Mage::getModel('catalog/product');

        try {
            foreach ($productIds as $_product)
            {
                $model->load($_product);
                $price = $model->getPrice();

                switch($operations){
                    case 'add_price':
                        $model->setPrice($price+$amount)->save();
                        break;
                    case 'deducted_price':
                        if(($price-$amount) < 0){
                            $this->_getSession()->addError($this->__('The price cannot be negative'));
                        } else {
                            $model->setPrice($price-$amount)->save();
                        }
                        break;
                    case 'increase_percentage_price':
                        $model->setPrice($price+($price*$amount/100))->save();
                        break;
                    case 'deduct_percentage_price':
                        if(($price-($price*$amount/100)) < 0){
                            $this->_getSession()->addError($this->__('The price cannot be negative'));
                        } else {
                            $model->setPrice($price-($price*$amount/100))->save();
                        }
                        break;
                    case 'increase_price':
                        $model->setPrice($price*$amount)->save();
                        break;
                    default:
                        $model->setPrice($price)->save();
                }
            }

            $this->_getSession()->addSuccess(
                $this->__('Total of %d record(s) have been updated.', count($productIds))
            );
        } catch (Mage_Core_Model_Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        } catch (Mage_Core_Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        } catch (Exception $e) {
            $this->_getSession()
                ->addException($e, $this->__('An error occurred while updating the product(s) price.'));
        }

        $this->_redirectReferer();
    }
}