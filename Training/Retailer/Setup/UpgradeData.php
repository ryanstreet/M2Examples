<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 9/20/2017
 * Time: 4:21 PM
 */

namespace Training\Retailer\Setup;


use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Training\Retailer\Model\ResourceModel\Retailer as RetailerResource;
use Training\Retailer\Model\RetailerFactory;

class UpgradeData implements UpgradeDataInterface
{

    /**
     * @var RetailerFactory
     */
    private $retailerFactory;
    /**
     * @var RetailerResource
     */
    private $retailerResource;

    public function __construct(
        RetailerFactory $retailerFactory,
        RetailerResource $retailerResource
    )
    {
        $this->retailerFactory = $retailerFactory;
        $this->retailerResource = $retailerResource;
    }

    /**
     * Upgrades data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $data = [
            ['name' => 'Retailer 1', 'street' => '123 Ryan St.', 'country_id' => 'US', 'region_id' => 47, 'postcode' => '45036'],
            ['name' => 'Retailer 2', 'street' => '234 Ryan St.', 'country_id' => 'US', 'region_id' => 47, 'postcode' => '45036'],
            ['name' => 'Retailer 3', 'street' => '456 Ryan St.', 'country_id' => 'US', 'region_id' => 47, 'postcode' => '45036'],
        ];

        foreach ($data as $retailer) {
            $retailerData = $this->retailerFactory->create()->setData($retailer);
            $this->retailerResource->save($retailerData);
        }


    }
}