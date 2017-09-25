<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 9/19/2017
 * Time: 10:22 AM
 */

namespace Training\Example\Plugin;


use Magento\Framework\DataObject\Factory;

class AlterCartQty
{

    /**
     * @var Factory
     */
    private $dataObjectFactory;

    public function __construct(
        Factory $dataObjectFactory
    )
    {
        $this->dataObjectFactory = $dataObjectFactory;
    }

    public function beforeAddProduct(\Magento\Checkout\Model\Cart $cart, $productInfo, $requestInfo) {

        if ($requestInfo instanceof \Magento\Framework\DataObject) {
            $request = $requestInfo;
        } elseif (is_numeric($requestInfo)) {
            $request = new \Magento\Framework\DataObject(['qty' => $requestInfo]);
        } elseif (is_array($requestInfo)) {
            $request = new \Magento\Framework\DataObject($requestInfo);
        } else {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('We found an invalid request for adding product to quote.')
            );
        }

        $request->setData('qty', 1);
        return [$productInfo, $request];
    }
}