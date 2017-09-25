<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 9/21/2017
 * Time: 10:04 AM
 */

namespace Training\Retailer\Model;


use Training\Retailer\Api\Data;
use Training\Retailer\Api\RetailerRepositoryInterface;
use Training\Retailer\Model\ResourceModel\Retailer as RetailerResource;

class RetailerRepository implements RetailerRepositoryInterface
{

    /**
     * @var RetailerFactory
     */
    private $retailerFactory;
    /**
     * @var RetailerResource
     */
    private $retailerResource;
    /**
     * @var Data\RetailerSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    public function __construct(
        RetailerFactory $retailerFactory,
        RetailerResource $retailerResource,
        Data\RetailerSearchResultsInterfaceFactory $searchResultsFactory
    )
    {
        $this->retailerFactory = $retailerFactory;
        $this->retailerResource = $retailerResource;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * @param Data\RetailerInterface $retailer
     * @return Data\RetailerInterface
     */
    public function save(\Training\Retailer\Api\Data\RetailerInterface $retailer)
    {
        $retailerModel = $this->retailerFactory->create();

        $retailerModel->setName($retailer->getName())
            ->setCountryId($retailer->getCountryId())
            ->setRegionId($retailer->getRegionId())
            ->setCity($retailer->getCity())
            ->setStreet($retailer->getStreet())
            ->setPostcode($retailer->getPostcode());

        $this->retailerResource->save($retailerModel);

        return $retailerModel;

    }

    /**
     * @param $retailerId
     * @return Data\RetailerInterface
     */
    public function get($retailerId)
    {
        $retailerModel = $this->retailerFactory->create();

        $this->retailerResource->load($retailerModel, $retailerId);

        return $retailerModel;
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Training\Retailer\Api\Data\RetailerSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);

        $collection = $this->retailerFactory->create()->getCollection();

        foreach($searchCriteria->getFilterGroups() as $filterGroup) {
            foreach($filterGroup as $filter) {
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }

        $searchResults->setTotalCount($collection->getSize());
        $sortOrders = $searchCriteria->getSortOrders();

        if($sortOrders) {
            foreach($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    $sortOrder->getDirection()
                );
            }
        }

        $collection->setCurPage($searchCriteria->getCurrentPage());
        $collection->setPageSize($searchCriteria->getPageSize());

        $collection->load();

        $searchResults->setItems($collection->getItems());

        return $searchResults;
    }

    /**
     * @param int $retailerId
     * @return boolean
     */
    public function delete($retailerId)
    {
        $retailerModel = $this->retailerFactory->create();

        $retailerModel->setId($retailerId);

        $this->retailerResource->delete($retailerModel);

        if(!$retailerModel->getId()) {
            return true;
        }  else return false;

    }

    /**
     * @param int $retailerId
     * @return array
     */
    public function getAssociatedProducts($retailerId)
    {
        $retailerModel = $this->get($retailerId);

        return $retailerModel->getAssociatedProductIds();


    }
}