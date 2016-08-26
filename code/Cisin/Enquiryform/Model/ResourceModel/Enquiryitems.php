<?php
/**
 * Copyright © 2015 Cisin. All rights reserved.
 */

namespace Cisin\Enquiryform\Model\ResourceModel;

class Enquiryitems extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Model Initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('cisin_enquiryform_enquiryitems', 'id');
    }
}
