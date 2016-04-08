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
        $source = Mage::getModel('updateprice/source');
        $_productCollection = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('price', 'sku')
            ->addAttributeToFilter('entity_id', array('in' => $productIds));

        try {
            foreach ($_productCollection as $_product)
            {
                $price = $_product->getPrice();
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
                        Mage::getSingleton('core/session')
                            ->addError('Performed an illegal action');
                }
                if($newPrice < 0){
                    Mage::getSingleton('core/session')
                        ->addError('The price cannot be negative. Product sku: '
                            . $_product->getSku());
                } else {
                    $_product->setPrice($newPrice);
                }
            }
            if($_productCollection->save()){
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