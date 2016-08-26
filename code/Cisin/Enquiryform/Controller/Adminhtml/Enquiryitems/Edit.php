<?php
/**
 * Copyright © 2015 Cisin. All rights reserved.
 */

namespace Cisin\Enquiryform\Controller\Adminhtml\Enquiryitems;

class Edit extends \Cisin\Enquiryform\Controller\Adminhtml\Enquiryitems
{

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create('Cisin\Enquiryform\Model\Enquiryitems');

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This item no longer exists.'));
                $this->_redirect('cisin_enquiryform/*');
                return;
            }
        }
        // set entered data if was error when we do save
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getPageData(true);
        if (!empty($data)) {
            $model->addData($data);
        }
        $this->_coreRegistry->register('current_cisin_enquiryform_enquiryitems', $model);
        $this->_initAction();
        $this->_view->getLayout()->getBlock('enquiryitems_enquiryitems_edit');
        $this->_view->renderLayout();
    }
}
