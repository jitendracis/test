<?php
/**
 * Adminhtml celebritycategory list block
 *
 */
namespace Cis\Celebritycategory\Block\Adminhtml;

class Celebritycategory extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_celebritycategory';
        $this->_blockGroup = 'Cis_Celebritycategory';
        $this->_headerText = __('Celebritycategory');
        $this->_addButtonLabel = __('Add New Celebritycategory');
        parent::_construct();
        if ($this->_isAllowedAction('Cis_Celebritycategory::save')) {
            $this->buttonList->update('add', 'label', __('Add New Celebritycategory'));
        } else {
            $this->buttonList->remove('add');
        }
    }
    
    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
