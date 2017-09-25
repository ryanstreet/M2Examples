<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 9/19/2017
 * Time: 9:21 AM
 */

namespace Training\Example\Plugin;

use Magento\Framework\App\RequestInterface;

class AlterPrice
{

    /**
     * @var RequestInterface
     */
    private $request;

    public function __construct(
        RequestInterface $request
    )
    {
        $this->request = $request;
    }

    public function afterGetPrice(\Magento\Catalog\Model\Product $product, $price) {
        return 10.0000;
    }

    public function aroundValidate(\Magento\Catalog\Model\Product $product, callable $proceed) {
        if($this->request->getParam('skip_validation')) {
            return [];
        }else {
            return $proceed();
        }
    }
}