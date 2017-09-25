<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 9/18/2017
 * Time: 4:03 PM
 */

namespace Training\Example\Model;


use Magento\Catalog\Api\ProductRepositoryInterface;

class Product
{

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository
    ) {

        $this->productRepository = $productRepository;
    }

    public function getDefaultProduct() {
        return $this->productRepository->get('asdf');
    }
}