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
class Cgi_Updateprice_Model_Action
{
    public function updatePrice($productIds, $operations, $amount)
    {
        $model  = Mage::getModel('catalog/product');
        $source = Mage::getModel('updateprice/source');

        try {
            foreach ($productIds as $_product)
            {
                $model->load($_product);
                $price = $model->getPrice();
                $newPrice = 0;

                switch($operations){
                    case $source::ADD_PRICE:
                        $newPrice = $price + $amount;
                        break;
                    case $source::DEDUCTED_PRICE:
                        $newPrice = $price - $amount;
                        break;
                    case $source::INCREASE_PERCENTAGE_PRICE:
                        $newPrice = $price + ($price * $amount / 100);
                        break;
                    case $source::DEDUCT_PERCENTAGE_PRICE:
                        $newPrice = $price - ($price * $amount / 100);
                        break;
                    case $source::INCREASE_PRICE:
                        $newPrice = $price * $amount;
                        break;
                    default:
                        $this->_getSession()->addError(
                            $this->__('Performed an illegal action')
                        );
                }
                if($newPrice < 0){
                    Mage::getSingleton('core/session')
                        ->addError('The price cannot be negative. Product sku: '
                            . $model->getSku());
                } else {
                    $model->setPrice($newPrice)->save();
                }
            }
            if($model->save()){
                Mage::getSingleton('core/session')
                    ->addSuccess('Total of %d record(s) have been updated.',
                        count($productIds));
            }
        } catch (Exception $e) {
            Mage::getSingleton('core/session')
                ->addException($e,
                    'An error occurred while updating the product(s) price.');
        }
    }
}