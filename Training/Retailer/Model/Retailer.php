<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 9/20/2017
 * Time: 3:30 PM
 */

namespace Training\Retailer\Model;

use Magento\Directory\Model\ResourceModel\Region;
use Magento\Framework\Model\AbstractModel;
use Training\Retailer\Api\Data\RetailerInterface;
use Magento\Directory\Model\RegionFactory;

class Retailer extends AbstractModel implements RetailerInterface
{

    /**
     * @var RegionFactory
     */
    private $regionFactory;
    /**
     * @var Region
     */
    private $regionResource;

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Training\Retailer\Model\ResourceModel\Retailer $resource,
        \Training\Retailer\Model\ResourceModel\Retailer\Collection $resourceCollection,
        RegionFactory $regionFactory,
        Region $regionResource
) {
        parent::__construct($context, $registry, $resource, $resourceCollection, []);
        $this->regionFactory = $regionFactory;
        $this->regionResource = $regionResource;
    }

    protected function _construct()
    {
        $this->_init(\Training\Retailer\Model\ResourceModel\Retailer::class);
    }

    public function getAssociatedProductIds()
    {
        return $this->_getResource()->getAssociatedProductIds($this->getId());
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @param string $name
     * @return RetailerInterface
     */
    public function setName($name)
    {
        $this->setData(self::NAME, $name);
        return $this;
    }

    /**
     * @return string
     */
    public function getCountryId()
    {
        return $this->getData(self::COUNTRY_ID);
    }

    /**
     * @param string $countryId
     * @return RetailerInterface
     */
    public function setCountryId($countryId)
    {
        $this->setData(self::COUNTRY_ID, $countryId);
        return $this;
    }

    public function getRegion() {
        $region = $this->regionFactory->create();
        $this->regionResource->load($region, $this->getRegionId());

        return $region->getName();

    }

    /**
     * @return int
     */
    public function getRegionId()
    {
        return $this->getData(self::REGION_ID);
    }

    /**
     * @param int $regionId
     * @return RetailerInterface
     */
    public function setRegionId($regionId)
    {
        $this->setData(self::REGION_ID, $regionId);
        return $this;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->getData(self::STREET);
    }

    /**
     * @param string $street
     * @return RetailerInterface
     */
    public function setStreet($street)
    {
        $this->setData(self::STREET, $street);
        return $this;
    }

    /**
     * @return string
     */
    public function getPostcode()
    {
        return $this->getData(self::POSTCODE);
    }

    /**
     * @param string $postcode
     * @return RetailerInterface
     */
    public function setPostcode($postcode)
    {
        $this->setData(self::POSTCODE, $postcode);
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @param string $createdAt
     * @return RetailerInterface
     */
    public function setCreatedAt($createdAt)
    {
        $this->setData(self::CREATED_AT, $createdAt);
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->getData(self::CITY);
    }

    /**
     * @param string $city
     * @return RetailerInterface
     */
    public function setCity($city)
    {
        $this->setData(self::CITY, $city);
        return $this;
    }
}