<?php
/**
 * Copyright © 2015 Cisin. All rights reserved.
 */

namespace Cisin\Enquiryform\Model\ResourceModel\Items;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Cisin\Enquiryform\Model\Items', 'Cisin\Enquiryform\Model\ResourceModel\Items');
    }
}
