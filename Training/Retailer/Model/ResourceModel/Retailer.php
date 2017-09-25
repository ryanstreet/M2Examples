<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 9/20/2017
 * Time: 3:31 PM
 */

namespace Training\Retailer\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Retailer extends AbstractDb
{

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('retailer', 'retailer_id');
    }

    public function getAssociatedProductIds($retailerId) {
        $select = $this->getConnection()->select()
            ->from(['r2p' => $this->getTable('retailer2product')])
            ->where('retailer_id=?', $retailerId);

        $rows = $this->getConnection()->fetchAll($select);
        $ids = [];
        $ids[] = array_map(function(array $row){
            return $row['product_id'];
        }, $rows);

        return $ids;
    }
}