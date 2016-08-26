<?php

/**
 * Celebrity Resource Collection
 */
namespace Cis\Celebrity\Model\ResourceModel\Celebrity;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Cis\Celebrity\Model\Celebrity', 'Cis\Celebrity\Model\ResourceModel\Celebrity');
    }
}
