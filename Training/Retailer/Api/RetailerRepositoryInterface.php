<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 9/21/2017
 * Time: 9:47 AM
 */

namespace Training\Retailer\Api;

/**
 * Interface RetailerRepositoryInterface
 * @package Training\Retailer\Api
 * @api
 */
interface RetailerRepositoryInterface
{

    /**
     * @param Data\RetailerInterface $retailer
     * @return Data\RetailerInterface
     */
    public function save(\Training\Retailer\Api\Data\RetailerInterface $retailer);

    /**
     * @param $retailerId
     * @return Data\RetailerInterface
     */
    public function get($retailerId);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Training\Retailer\Api\Data\RetailerSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * @param int $retailerId
     * @return boolean
     */
    public function delete($retailerId);

    /**
     * @param int $retailerId
     * @return array
     */
    public function getAssociatedProducts($retailerId);
}