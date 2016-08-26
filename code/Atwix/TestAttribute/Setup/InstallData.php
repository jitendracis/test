<?php

namespace Atwix\TestAttribute\Setup;
use Magento\Framework\Module\Setup\Migration;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Catalog\Setup\CategorySetupFactory;
class InstallData implements InstallDataInterface
{
    public function __construct(CategorySetupFactory $categorySetupFactory)
    {
        $this->categorySetupFactory = $categorySetupFactory;
    }
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $categorySetup = $this->categorySetupFactory->create(['setup' => $setup]);
        $entityTypeId = $categorySetup->getEntityTypeId(\Magento\Catalog\Model\Category::ENTITY);
        $attributeSetId = $categorySetup->getDefaultAttributeSetId($entityTypeId);
        
        $categorySetup->removeAttribute(
            \Magento\Catalog\Model\Category::ENTITY, 'featured_image' );
        $categorySetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY, 'featured_image', [
                'type' => 'varchar',
                'label' => 'Banner Image',
                'input' => 'image',
                'backend' => 'Magento\Catalog\Model\Category\Attribute\Backend\Image',
                'required' => false,
                'sort_order' => 5,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'General Information',
            ]
        );
        
        $categorySetup->removeAttribute(
                \Magento\Catalog\Model\Category::ENTITY, 'menu_image_position' );
        $categorySetup->addAttribute(
                \Magento\Catalog\Model\Category::ENTITY, 'menu_image_position', [
                    'type' => 'varchar',
                    'label' => 'Menu Image Position',
                    'input' => 'select',
                    'option' => array (
                              'value' => array('optionone'=>array(0=>'None'),'optiontwo'=>array(0=>'Left'),'optionthree'=>array(0=>'Right'))
                    ),
                    'backend' => 'Magento\Catalog\Model\Category\Attribute\Backend\Image',
                    'required' => false,
                    'sort_order' => 6,
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                    'group' => 'General Information',
                ]
        );
            
        $installer->endSetup();
    }
}