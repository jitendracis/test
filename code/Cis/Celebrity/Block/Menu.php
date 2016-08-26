<?php
namespace Cis\Celebrity\Block;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Helper\Category;
use Magento\Framework\View\Element\Template\Context;
use Magento\Catalog\Model\Indexer\Category\Flat\State;

class Menu
    extends Template
{
    protected $_categoryHelper;
    protected $categoryFlatConfig;

    public function __construct(
        Category $categoryHelper,
        State $categoryFlatState,
        Context $context,
        \Magento\Eav\Model\Config $eavConfig,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory
    ){

        $this->_categoryHelper = $categoryHelper;
        $this->categoryFlatConfig = $categoryFlatState;
        $this->_categoryFactory = $categoryFactory;
        $this->eavConfig = $eavConfig;

        parent::__construct($context);
    }

    public function getRootCategories(){

        $categories = $this->_categoryHelper->getStoreCategories(true, false, true);

        return $categories;
    }

    public function getSubCategories($category)
    {
        if ($this->categoryFlatConfig->isFlatEnabled() && $category->getUseFlatResource()) {
            $subCategories = (array)$category->getChildrenNodes();
        } else {
            $subCategories = $category->getChildren();
        }
        return $subCategories;
    }

    public function getCategoryUrl($category){
        return $this->_categoryHelper->getCategoryUrl($category);
    }
    
    public function getImageUrl($category){
        $category = $this->_categoryFactory->create()->load($category->getId());
        return $category->getImageUrl();
    }
    
    public function getFeatureImageUrl($category){    
        $url = false;
        $image = $this->_categoryFactory->create()->load($category->getId())->getFeaturedImage();
        if ($image) {
            $url = $this->_storeManager->getStore()->getBaseUrl(
                \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
            ) . 'catalog/category/' . $image;
        }
        return $url;
    }
    
    public function getImagePosition($category){
        $category = $this->_categoryFactory->create()->load($category->getId());
        $position =  '';
        $attribute = $this->eavConfig->getAttribute('catalog_category', 'menu_image_position');
        $options = $attribute->getSource()->getAllOptions();
        $optionArr = array();
        foreach($options as $option){
            if(! empty($option['value'])){
                $optionArr[$option['value']] = $option['label'];
            }
        }
        if(!empty($category->getMenuImagePosition())){
            $position = $optionArr[$category->getMenuImagePosition()]; //die;
        }
        return $position;
    }
}

?>