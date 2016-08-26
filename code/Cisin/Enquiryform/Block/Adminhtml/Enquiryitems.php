<?php
/**
 * Copyright © 2015 Cisin. All rights reserved.
 */
namespace Cisin\Enquiryform\Block\Adminhtml;

class Enquiryitems extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {   
        $this->_controller = 'enquiryitems';
        $this->_headerText = __('Enquiry');
        $this->_addButtonLabel = __('Add New Item');
        parent::_construct();
        $this->removeButton('add');
    }
}
