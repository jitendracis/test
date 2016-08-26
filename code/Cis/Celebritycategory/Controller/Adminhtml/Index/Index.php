<?php

namespace Cis\Celebritycategory\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
	/**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
	
    /**
     * Check the permission to run it
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Cis_Celebritycategory::celebritycategory_manage');
    }

    /**
     * Celebritycategory List action
     *
     * @return void
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu(
            'Cis_Celebritycategory::celebritycategory_manage'
        )->addBreadcrumb(
            __('Celebritycategory'),
            __('Celebritycategory')
        )->addBreadcrumb(
            __('Manage Celebritycategory'),
            __('Manage Celebritycategory')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Celebritycategory'));
        return $resultPage;
    }
}
