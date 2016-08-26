<?php

namespace Cis\Celebrity\Model\ResourceModel;

/**
 * Celebrity Resource Model
 */
class Celebrity extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('cis_celebrity', 'celebrity_id');
    }
}
