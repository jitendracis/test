<?php
/**
 * Copyright © 2015 Cisin. All rights reserved.
 */

namespace Cisin\Enquiryform\Controller\Adminhtml\Items;

class NewAction extends \Cisin\Enquiryform\Controller\Adminhtml\Items
{

    public function execute()
    {
        $this->_forward('edit');
    }
}
