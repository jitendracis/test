<?php
/**
 * Adminhtml celebrity list block
 *
 */
namespace Cis\Celebrity\Block\Adminhtml;

class Celebrity extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_celebrity';
        $this->_blockGroup = 'Cis_Celebrity';
        $this->_headerText = __('Celebrity');
        $this->_addButtonLabel = __('Add New Celebrity');
        parent::_construct();
        if ($this->_isAllowedAction('Cis_Celebrity::save')) {
            $this->buttonList->update('add', 'label', __('Add New Celebrity'));
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
