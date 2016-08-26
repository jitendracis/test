<?php

namespace Cis\Celebrity\Block;

/**
 * Celebrity content block
 */
class Celebrity extends \Magento\Framework\View\Element\Template
{
    /**
     * Celebrity collection
     *
     * @var Cis\Celebrity\Model\ResourceModel\Celebrity\Collection
     */
    protected $_celebrityCollection = null;
    
    /**
     * Celebrity factory
     *
     * @var \Cis\Celebrity\Model\CelebrityFactory
     */
    protected $_celebrityCollectionFactory;
    
    /** @var \Cis\Celebrity\Helper\Data */
    protected $_dataHelper;
    
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Cis\Celebrity\Model\ResourceModel\Celebrity\CollectionFactory $celebrityCollectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Cis\Celebrity\Model\ResourceModel\Celebrity\CollectionFactory $celebrityCollectionFactory,
        \Cis\Celebrity\Helper\Data $dataHelper,
        array $data = []
    ) {
        $this->_celebrityCollectionFactory = $celebrityCollectionFactory;
        $this->_dataHelper = $dataHelper;
        parent::__construct(
            $context,
            $data
        );
    }
    
    /**
     * Retrieve celebrity collection
     *
     * @return Cis\Celebrity\Model\ResourceModel\Celebrity\Collection
     */
    protected function _getCollection()
    {
        $collection = $this->_celebrityCollectionFactory->create();
        return $collection;
    }
    
    /**
     * Retrieve prepared celebrity collection
     *
     * @return Cis\Celebrity\Model\ResourceModel\Celebrity\Collection
     */
    public function getCollection()
    {
        if (is_null($this->_celebrityCollection)) {
            $this->_celebrityCollection = $this->_getCollection();
            $this->_celebrityCollection->setCurPage($this->getCurrentPage());
            $this->_celebrityCollection->setPageSize($this->_dataHelper->getCelebrityPerPage());
            $this->_celebrityCollection->setOrder('published_at','asc');
        }

        return $this->_celebrityCollection;
    }
    
    /**
     * Fetch the current page for the celebrity list
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
     * @param Cis\Celebrity\Model\Celebrity $celebrityItem
     * @return string
     */
    public function getItemUrl($celebrityItem)
    {
        return $this->getUrl('*/*/view', array('id' => $celebrityItem->getId()));
    }
    
    /**
     * Return URL for resized Celebrity Item image
     *
     * @param Cis\Celebrity\Model\Celebrity $item
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
        $pager = $this->getChildBlock('celebrity_list_pager');
        if ($pager instanceof \Magento\Framework\Object) {
            $celebrityPerPage = $this->_dataHelper->getCelebrityPerPage();

            $pager->setAvailableLimit([$celebrityPerPage => $celebrityPerPage]);
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
