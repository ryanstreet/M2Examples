<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 9/20/2017
 * Time: 3:33 PM
 */

namespace Training\Retailer\Model\ResourceModel\Retailer;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected function _construct()
    {
        $this->_init(
            \Training\Retailer\Model\Retailer::class,
            \Training\Retailer\Model\ResourceModel\Retailer::class
        );
    }

    public function addFilterByProduct($productId) {
        $productId = (int)$productId;
        $this->getSelect()
            ->join(
                ['r2p' => $this->getTable('retailer2product')],
                "main_table.retailer_id = r2p.retailer_id AND r2p.product_id = $productId"
            );
    }
}