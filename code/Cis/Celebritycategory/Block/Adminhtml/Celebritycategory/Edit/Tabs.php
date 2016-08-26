<?php
namespace Cis\Celebritycategory\Block\Adminhtml\Celebritycategory\Edit;

/**
 * Admin celebritycategory left menu
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('page_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Celebritycategory Information'));
    }
}
