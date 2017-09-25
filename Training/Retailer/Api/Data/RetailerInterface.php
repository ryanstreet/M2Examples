<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 9/21/2017
 * Time: 9:50 AM
 */

namespace Training\Retailer\Api\Data;

/**
 * Interface RetailerInterface
 * @package Training\Retailer\Api\Data
 * @api
 */
interface RetailerInterface
{

    const RETAILER_ID = 'retailer_id';
    const NAME = 'name';
    const STREET = 'street';
    const COUNTRY_ID = 'country_id';
    const REGION_ID = 'region_id';
    const CITY = 'city';
    const POSTCODE = 'postcode';
    const CREATED_AT = 'created_at';

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $retailerId
     * @return RetailerInterface
     */
    public function setId($retailerId);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return RetailerInterface
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getCountryId();

    /**
     * @param string $countryId
     * @return RetailerInterface
     */
    public function setCountryId($countryId);

    /**
     * @return int
     */
    public function getRegionId();

    /**
     * @param int $regionId
     * @return RetailerInterface
     */
    public function setRegionId($regionId);

    /**
     * @return string
     */
    public function getStreet();

    /**
     * @param string $street
     * @return RetailerInterface
     */
    public function setStreet($street);

    /**
     * @return string
     */
    public function getPostcode();

    /**
     * @param string $postcode
     * @return RetailerInterface
     */
    public function setPostcode($postcode);

    /**
     * @return string
     */
    public function getCreatedAt();

    /**
     * @param string $createdAt
     * @return RetailerInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * @return string
     */
    public function getCity();

    /**
     * @param string $city
     * @return RetailerInterface
     */
    public function setCity($city);
}