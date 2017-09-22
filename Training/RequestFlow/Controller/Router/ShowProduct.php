<?php

namespace Training\RequestFlow\Controller;


use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;
use Magento\Framework\Exception\NotFoundException;

class ShowProduct implements RouterInterface {

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
    ) {
        $this->productRepository = $productRepository;
        $this->actionFactory     = $actionFactory;
    }

    /**
     * Match application action by request
     *
     * @param RequestInterface $request
     *
     * @return ActionInterface
     */
    public function match( RequestInterface $request ) {
        $pathParts = explode( '/', ltrim( $request->getPathInfo() ), 2 );

        $forward = $this->actionFactory->create( 'Magento\Framework\App\Action\Forward' );

        if ( $pathParts[0] !== 'showproduct' ) {
            return $forward;
        }

        if ( ! isset( $pathParts[1] ) ) {
            return $forward;
        }

        $sku = $pathParts[1];

        try {
            $product = $this->productRepository->get( $sku );
            $request->setModuleName( 'catalog' )
                    ->setControllerName( 'product' )
                    ->setActionName( 'view' )
                    ->setParam( 'id', $product->getId() );
        } catch ( NotFoundException $e ) {
            return $forward;
        }

        return $forward;
    }
}