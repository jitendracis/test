<?php

/**
 * Celebritycategory Resource Collection
 */
namespace Cis\Celebritycategory\Model\ResourceModel\Celebritycategory;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Cis\Celebritycategory\Model\Celebritycategory', 'Cis\Celebritycategory\Model\ResourceModel\Celebritycategory');
    }
}
