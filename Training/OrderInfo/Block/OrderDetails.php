<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 9/20/2017
 * Time: 12:02 PM
 */

namespace Training\OrderInfo\Block;


use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;

class OrderDetails extends Template
{

    /**
     * @var Registry
     */
    private $registry;

    public function __construct(
        Template\Context $context,
        Registry $registry,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->registry = $registry;
    }

    public function getOrderData() {
        return $this->registry->registry('order_data');
    }

}