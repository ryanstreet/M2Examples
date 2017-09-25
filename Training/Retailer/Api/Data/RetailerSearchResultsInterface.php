<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 9/21/2017
 * Time: 10:02 AM
 */

namespace Training\Retailer\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface RetailerSearchResultsInterface extends SearchResultsInterface
{

    /**
     * @return \Training\Retailer\Api\Data\RetailerInterface[]
     */
    public function getItems();

    /**
     * @param \Training\Retailer\Api\Data\RetailerInterface[] $items
     * @return RetailerSearchResultsInterface
     */
    public function setItems(array $items);

}