<?php
/**
 * {Description}
 *
 * @category    Wcb
 * @package     Wcb_
 * @contact     Ryan Street <rstreet@wcbradley.com>
 */

namespace Training\Basics\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class SpecialPrice implements ObserverInterface {

    /**
     * @param Observer $observer
     *
     * @return void
     */
    public function execute( \Magento\Framework\Event\Observer $observer ) {
        /** @var \Magento\Catalog\Api\Data\ProductInterface $product */
        $product = $observer->getData( 'product' );

        $product->setPrice( 10.0000 );
    }
}