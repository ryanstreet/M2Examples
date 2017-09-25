<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 9/19/2017
 * Time: 3:26 PM
 */

namespace Training\Example\Controller;


use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;

class Router implements RouterInterface
{

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;
    /**
     * @var ActionFactory
     */
    private $actionFactory;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        ActionFactory $actionFactory
    )
    {
        $this->productRepository = $productRepository;
        $this->actionFactory = $actionFactory;
    }

    /**
     * Match application action by request
     *
     * @param RequestInterface $request
     * @return ActionInterface
     */
    public function match(RequestInterface $request)
    {
        $pathParts = explode('/', ltrim($request->getPathInfo()), 2);

        if($pathParts[0] == 'showproduct') {

            if(isset($pathParts[1])) {
                $sku = $pathParts[1];
                $product = $this->productRepository->get($sku);
                $request->setModuleName('catalog')
                        ->setControllerName('product')
                        ->setActionName('view')
                        ->setParam('id', $product->getId());
                return $this->actionFactory
                    ->create('Magento\Framework\App\Action\Forward');
            }  else return false;

        } else return false;


    }
}