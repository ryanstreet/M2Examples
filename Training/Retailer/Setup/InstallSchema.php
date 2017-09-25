<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 9/20/2017
 * Time: 2:33 PM
 */

namespace Training\Retailer\Setup;


use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $table = $installer->getConnection()->newTable(
            $installer->getTable('retailer')
        )->addColumn(
            'retailer_id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'Retailer ID'
        )->addColumn(
            'name',
            Table::TYPE_TEXT,
            '255',
            [],
            'Retailer Name'
        )->addColumn(
            'country_id',
            Table::TYPE_TEXT,
            2,
            ['nullable' => false, 'default' => false],
            'Country ID'
        )->addColumn(
            'region_id',
            Table::TYPE_INTEGER,
            null,
            ['unsigned' => true, 'nullable' => false],
            'Region ID'
        )->addColumn(
            'city',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'City'
        )->addColumn(
            'street',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Street'
        )->addColumn(
            'postcode',
            Table::TYPE_TEXT,
            10,
            ['nullable' => false],
            'Postcode'
        )->addColumn(
            'created_at',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
            'Created At'
        )->addForeignKey(
            $installer->getFkName('retailer', 'country_id', 'directory_country', 'country_id'),
            'country_id',
            $installer->getTable('directory_country'),
            'country_id',
            Table::ACTION_CASCADE
        )->addForeignKey(
            $installer->getFkName('retailer', 'region_id', 'directory_country_region', 'region_id'),
            'region_id',
            $installer->getTable('directory_country_region'),
            'region_id',
            Table::ACTION_CASCADE
        )->setComment('Retailer Table');

        $installer->getConnection()->createTable($table);
        $installer->endSetup();
    }
}