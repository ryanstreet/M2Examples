<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 9/19/2017
 * Time: 11:17 AM
 */

namespace Training\Example\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class SpecialPrice implements ObserverInterface
{

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /** @var \Magento\Catalog\Model\Product $product */
        $product = $observer->getData('product');
        $product->setData('special_price', 9.99);
    }
}