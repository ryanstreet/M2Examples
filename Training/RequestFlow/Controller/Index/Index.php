<?php
namespace Training\RequestFlow\Controller\Index;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NotFoundException;
use Magento\Sales\Api\Data\CreditmemoItemInterface;
use Magento\Sales\Api\OrderRepositoryInterface;

class Index extends Action {

    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;

    public function __construct(
        Context $context,
        OrderRepositoryInterface $orderRepository
    ) {
        parent::__construct( $context );
        $this->orderRepository = $orderRepository;
    }

    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute() {
        $orderId = $this->getRequest()->getParam( 'order_id' );

        if ( ! $orderId ) {
            throw new NotFoundException( __( 'No Order ID Found' ) );
        }

        $order = $this->orderRepository->get( $orderId );

        $data = [
            'order_status'   => $order->getStatus(),
            'total'          => $order->getGrandTotal(),
            'total_invoiced' => $order->getTotalInvoiced(),
            'items'          => array_map( function ( CreditmemoItemInterface $item ) {
                return [
                    'sku'   => $item->getSku(),
                    'id'    => $item->getOrderItemId(),
                    'price' => $item->getPrice()
                ];
            }, $order->getItems() )
        ];

        /** @var Json $response */
        $response = $this->resultFactory->create( ResultFactory::TYPE_JSON );

        $response->setData( $data );

        return $response;
    }
}