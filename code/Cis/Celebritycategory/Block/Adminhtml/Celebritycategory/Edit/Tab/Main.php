<?php
namespace Cis\Celebritycategory\Block\Adminhtml\Celebritycategory\Edit\Tab;

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
        array $data = []
    ) {
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
        $model = $this->_coreRegistry->registry('celebritycategory');

        /*
         * Checking if user have permissions to save information
         */
        if ($this->_isAllowedAction('Cis_Celebritycategory::save')) {
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('celebritycategory_main_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Celebritycategory Information')]);

        if ($model->getId()) {
            $fieldset->addField('celebritycategory_id', 'hidden', ['name' => 'celebritycategory_id']);
        }
        $fieldset->addField(
            'title',
            'text',
            [
                'name' => 'title',
                'label' => __('Celebrity category Title'),
                'title' => __('Celebrity category Title'),
                'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
        
        $fieldset->addField(
            'categoryStatus',
            'select',
            [
                'name' => 'categoryStatus',
                'label' => __('Celebrity category Status'),
                'title' => __('Celebrity category Status'),
                'required' => false,
                'class'   => 'categoryStatus',
                'disabled' => $isElementDisabled,
                'options' => array('1' => 'Enable','0' => 'Disable',),
            ]
        );
        
        
        $fieldset->addField('categoryChild', 'select', array(
            'label'     => ('Celebrity category Child'),
            'title' => __('Celebrity category Child'),
            'required'  => false,
            //'onchange' => 'checkSelectedItem(this.value)',
            'name'      => 'categoryChild',
            'values'    => array(
            array(
                'value'     => '1',
                'label'     => 'Yes',      
            ),
            array(
               'value'     => '0',
               'label'     => 'No',         
            ),
        )
        ////))->setAfterElementHtml("<script type=\"text/javascript\">
        ////    function checkSelectedItem(selectElement){ 
        ////       alert(selectElement);
        ////       if(selectElement == 0)
        ////       {
        ////            document.getElementById('celebritycategory_main_categoryParentId').style.display = 'none';
        ////       }
        ////       else
        ////       {
        ////            document.getElementById('celebritycategory_main_categoryParentId').style.display = 'block';
        ////       }
        ////       
        ////    }
        ////</script>"
        //
        ));
        $currentId = '';
        if($model->getId()){
            $currentId = $model->getId();
        }
        $fieldset->addField(
            'categoryParentId',
            'select',
            [
                'class'   => 'categoryParentId',
                'name'      => 'categoryParentId',
                //'label'     => __('Celebrity category ParentId'),
                'disabled' => $isElementDisabled,
                'values'   =>  $model->toOptionArray($currentId),
            ]
        );
        
        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $fieldset->addField('published_at', 'date', [
            'name'     => 'published_at',
            'date_format' => $dateFormat,
            'image'    => $this->getViewFileUrl('images/grid-cal.gif'),
            'value' => $model->getPublishedAt(),
            'label'    => __('Publishing Date'),
            'title'    => __('Publishing Date'),
            'required' => true
        ]);
        $this->_eventManager->dispatch('adminhtml_celebritycategory_edit_tab_main_prepare_form', ['form' => $form]);
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
        return __('Celebritycategory Information');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Celebritycategory Information');
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
