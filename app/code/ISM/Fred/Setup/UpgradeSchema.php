<?php
namespace ISM\Fred\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '0.1.1') < 0) {
            //code to upgrade to 0.1.1
        }

        if (version_compare($context->getVersion(), '0.1.2') < 0) {
            //code to upgrade to 0.1.2
        }

        $setup->endSetup();
    }
}