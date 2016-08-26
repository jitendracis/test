<?php
/**
 * Copyright © 2015 Cisin. All rights reserved.
 */

namespace Cisin\Enquiryform\Controller\Adminhtml\Contactsitems;

class Edit extends \Cisin\Enquiryform\Controller\Adminhtml\Contactsitems
{

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create('Cisin\Enquiryform\Model\Contactsitems');

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
        $this->_coreRegistry->register('current_cisin_enquiryform_contactsitems', $model);
        $this->_initAction();
        $this->_view->getLayout()->getBlock('contactsitems_contactsitems_edit');
        $this->_view->renderLayout();
    }
}
