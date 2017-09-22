<?php
/**
 * {Description}
 *
 * @category    Wcb
 * @package     Wcb_
 * @contact     Ryan Street <rstreet@wcbradley.com>
 */

namespace Training\Basics\Plugin;


class AlterQty {

    /**
     * Change the Qty of a product added to cart to 1
     *
     * @param \Magento\Checkout\Model\Cart $cart
     * @param $productInfo
     * @param $requestInfo
     *
     * @return array
     */
    public function beforeAddProduct( \Magento\Checkout\Model\Cart $cart, $productInfo, $requestInfo ) {
        if ( $requestInfo instanceof \Magento\Framework\DataObject ) {
            $requestInfo->setData('qty',  1 );
        } elseif ( is_numeric( $requestInfo ) ) {
            $requestInfo = new \Magento\Framework\DataObject( [ 'qty' => 1 ] );
        } elseif ( is_array( $requestInfo ) ) {
            $requestInfo['qty'] = 1;
        }

        return [$productInfo, $requestInfo];
    }
}