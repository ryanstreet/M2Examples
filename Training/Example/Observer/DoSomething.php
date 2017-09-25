<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 9/19/2017
 * Time: 10:59 AM
 */

namespace Training\Example\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class DoSomething implements ObserverInterface
{

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        // TODO: Implement execute() method.
    }
}