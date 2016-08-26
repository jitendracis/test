<?php
namespace Cis\Celebrity\Block\Adminhtml\Celebrity\Edit\Tab;

/**
 * Cms page edit form main tab
 */
class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        array $data = []
    ) {
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /* @var $model \Magento\Cms\Model\Page */
        $model = $this->_coreRegistry->registry('celebrity');

        /*
         * Checking if user have permissions to save information
         */
        if ($this->_isAllowedAction('Cis_Celebrity::save')) {
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('celebrity_main_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Celebrity Information')]);

        if ($model->getId()) {
            $fieldset->addField('celebrity_id', 'hidden', ['name' => 'celebrity_id']);
        }

        $fieldset->addField(
            'title',
            'text',
            [
                'name' => 'title',
                'label' => __('Celebrity Title'),
                'title' => __('Celebrity Title'),
                'required' => true,
                'disabled' => $isElementDisabled
            ]
        );

        $fieldset->addField(
            'productlink',
            'text',
            [
                'name' => 'productlink',
                'label' => __('Product URL'),
                'title' => __('Product URL'),
                'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
        
        $fieldset->addField(
            'categoryId',
            'select',
            [
                'class'   => 'categoryId',
                'name'      => 'categoryId',
                'label'     => __('Celebrity category'),
                'required' => true,
                'disabled' => $isElementDisabled,
                'values'   =>  $model->toCatOptionArray(),
            ]
        );

        $contentField = $fieldset->addField(
            'shortdesciption1',
            'text',
            [
                'name' => 'shortdesciption1',
                'label' => __('Short Description Line 1'),
                'title' => __('Short Description Line 1'),
                'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
        
        $contentField = $fieldset->addField(
            'shortdesciption2',
            'text',
            [
                'name' => 'shortdesciption2',
                'label' => __('Short Description Line 2'),
                'title' => __('Short Description Line 2'),
                'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
        
        
        $this->_eventManager->dispatch('adminhtml_celebrity_edit_tab_main_prepare_form', ['form' => $form]);

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Celebrity Information');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Celebrity Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
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
