<?php

namespace Cis\Celebritycategory\Model\ResourceModel;

/**
 * Celebritycategory Resource Model
 */
class Celebritycategory extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('cis_celebritycategory', 'celebritycategory_id');
    }
}
