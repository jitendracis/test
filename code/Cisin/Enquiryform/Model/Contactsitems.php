<?php
/**
 * Copyright © 2015 Cisin. All rights reserved.
 */

namespace Cisin\Enquiryform\Model;

class Contactsitems extends \Magento\Framework\Model\AbstractModel 
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('Cisin\Enquiryform\Model\ResourceModel\Contactsitems');
    }
}
