<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 9/19/2017
 * Time: 4:40 PM
 */

namespace Training\OrderInfo\Controller\Index;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Registry;
use Magento\Sales\Api\Data\OrderItemInterface;
use Magento\Sales\Api\OrderRepositoryInterface;

class Index extends Action
{

    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;
    /**
     * @var Registry
     */
    private $registry;

    public function __construct(
        Context $context,
        OrderRepositoryInterface $orderRepository,
        Registry $registry
    )
    {
        parent::__construct($context);
        $this->orderRepository = $orderRepository;
        $this->registry = $registry;
    }

    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {

        $orderId = $this->getRequest()->getParam('order_id');
        $order = $this->orderRepository->get($orderId);

        $data = [
            'status' => $order->getStatus(),
            'total' => $order->getGrandTotal(),
            'total_invoiced' => $order->getTotalInvoiced(),
            'items' => array_map(function (OrderItemInterface $item) {
                return [
                    'item' => $item->getItemId(),
                    'sku' => $item->getSku(),
                    'name' => $item->getName(),
                    'price' => $item->getPrice()
                ];
            }, $order->getItems())
        ];

        if($this->getRequest()->getParam('isjson')) {
            /** @var Json $result */
            $result = $this->resultFactory->create(ResultFactory::TYPE_JSON);
            $result->setData($data);
        } else {
            $this->registry->register('order_data', $data);
            $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        }

        return $result;
    }
}