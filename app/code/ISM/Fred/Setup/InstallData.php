<?php

namespace ISM\Fred\Setup;

use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Store\Model\StoreManager;

class InstallData implements InstallDataInterface
{
    public $storeManager;
    protected $objectManager;

    public function __construct(ObjectManagerInterface $objectManager, StoreManager $storeManager)
    {
        $this->objectManager = $objectManager;
        $this->storeManager = $storeManager;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $setup->endSetup();
    }
}