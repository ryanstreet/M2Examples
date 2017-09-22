<?php
/**
 * {Description}
 *
 * @category    Wcb
 * @package     Wcb_
 * @contact     Ryan Street <rstreet@wcbradley.com>
 */

namespace Training\Basics\Plugin;


class AlterValidate {

    public function aroundValidate(\Magento\Catalog\Model\Product $product, callable $proceed) {

        // condition to see if we want to call validate method.  Will leave blank for now...
        if(true) {
            $result = $proceed();
        }  else {
            $result = true;
        }

        return $result;
    }
}