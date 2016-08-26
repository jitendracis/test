<?php
/**
 * Copyright © 2015 Cisin. All rights reserved.
 */
namespace Cisin\Enquiryform\Block\Adminhtml\Contactsitems\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('cisin_enquiryform_contactsitems_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Enquiry'));
    }
}
