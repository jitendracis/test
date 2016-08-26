<?php

namespace Cis\Celebritycategory\Block;

/**
 * Celebritycategory content block
 */
class Celebritycategory extends \Magento\Framework\View\Element\Template
{
    /**
     * Celebritycategory collection
     *
     * @var Cis\Celebritycategory\Model\ResourceModel\Celebritycategory\Collection
     */
    protected $_celebritycategoryCollection = null;
    
    /**
     * Celebritycategory factory
     *
     * @var \Cis\Celebritycategory\Model\CelebritycategoryFactory
     */
    protected $_celebritycategoryCollectionFactory;
    
    /** @var \Cis\Celebritycategory\Helper\Data */
    protected $_dataHelper;
    
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Cis\Celebritycategory\Model\ResourceModel\Celebritycategory\CollectionFactory $celebritycategoryCollectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Cis\Celebritycategory\Model\ResourceModel\Celebritycategory\CollectionFactory $celebritycategoryCollectionFactory,
        \Cis\Celebritycategory\Helper\Data $dataHelper,
        array $data = []
    ) {
        $this->_celebritycategoryCollectionFactory = $celebritycategoryCollectionFactory;
        $this->_dataHelper = $dataHelper;
        parent::__construct(
            $context,
            $data
        );
    }
    
    /**
     * Retrieve celebritycategory collection
     *
     * @return Cis\Celebritycategory\Model\ResourceModel\Celebritycategory\Collection
     */
    protected function _getCollection()
    {
        $collection = $this->_celebritycategoryCollectionFactory->create();
        return $collection;
    }
    
    /**
     * Retrieve prepared celebritycategory collection
     *
     * @return Cis\Celebritycategory\Model\ResourceModel\Celebritycategory\Collection
     */
    public function getCollection()
    {
        if (is_null($this->_celebritycategoryCollection)) {
            $this->_celebritycategoryCollection = $this->_getCollection();
            $this->_celebritycategoryCollection->setCurPage($this->getCurrentPage());
            $this->_celebritycategoryCollection->setPageSize($this->_dataHelper->getCelebritycategoryPerPage());
            $this->_celebritycategoryCollection->setOrder('published_at','asc');
        }

        return $this->_celebritycategoryCollection;
    }
    
    /**
     * Fetch the current page for the celebritycategory list
     *
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->getData('current_page') ? $this->getData('current_page') : 1;
    }
    
    /**
     * Return URL to item's view page
     *
     * @param Cis\Celebritycategory\Model\Celebritycategory $celebritycategoryItem
     * @return string
     */
    public function getItemUrl($celebritycategoryItem)
    {
        return $this->getUrl('*/*/view', array('id' => $celebritycategoryItem->getId()));
    }
    
    /**
     * Return URL for resized Celebritycategory Item image
     *
     * @param Cis\Celebritycategory\Model\Celebritycategory $item
     * @param integer $width
     * @return string|false
     */
    public function getImageUrl($item, $width)
    {
        return $this->_dataHelper->resize($item, $width);
    }
    
    /**
     * Get a pager
     *
     * @return string|null
     */
    public function getPager()
    {
        $pager = $this->getChildBlock('celebritycategory_list_pager');
        if ($pager instanceof \Magento\Framework\Object) {
            $celebritycategoryPerPage = $this->_dataHelper->getCelebritycategoryPerPage();

            $pager->setAvailableLimit([$celebritycategoryPerPage => $celebritycategoryPerPage]);
            $pager->setTotalNum($this->getCollection()->getSize());
            $pager->setCollection($this->getCollection());
            $pager->setShowPerPage(TRUE);
            $pager->setFrameLength(
                $this->_scopeConfig->getValue(
                    'design/pagination/pagination_frame',
                    \Magento\Store\Model\ScopeInterface::SCOPE_STORE
                )
            )->setJump(
                $this->_scopeConfig->getValue(
                    'design/pagination/pagination_frame_skip',
                    \Magento\Store\Model\ScopeInterface::SCOPE_STORE
                )
            );

            return $pager->toHtml();
        }

        return NULL;
    }
}
