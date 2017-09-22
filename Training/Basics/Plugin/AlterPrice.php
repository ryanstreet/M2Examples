<?php
/**
 * {Description}
 *
 * @category    Wcb
 * @package     Wcb_
 * @contact     Ryan Street <rstreet@wcbradley.com>
 */

namespace Training\Basics\Plugin;


class AlterPrice {

    /**
     * Override the return result and instead return only a price of $10
     *
     * @param \Magento\Catalog\Model\Product $product
     * @param $result
     *
     * @return float
     */
    public function afterGetPrice(\Magento\Catalog\Model\Product $product, $result) {
        return 10.0000;
    }
}