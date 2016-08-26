<?php
/**
 * Copyright © 2015 Cisin. All rights reserved.
 */

namespace Cisin\Enquiryform\Model\ResourceModel\Enquiryitems;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Cisin\Enquiryform\Model\Enquiryitems', 'Cisin\Enquiryform\Model\ResourceModel\Enquiryitems');
    }
}
