<?php
/**
 * Copyright © 2015 Cisin. All rights reserved.
 */

namespace Cisin\Enquiryform\Controller\Adminhtml\Items;

class Index extends \Cisin\Enquiryform\Controller\Adminhtml\Items
{
    /**
     * Items list.
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Cisin_Enquiryform::enquiryform');
        $resultPage->getConfig()->getTitle()->prepend(__('Cisin Items'));
        $resultPage->addBreadcrumb(__('Cisin'), __('Cisin'));
        $resultPage->addBreadcrumb(__('Items'), __('Items'));
        return $resultPage;
    }
}
