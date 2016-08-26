<?php
/**
 * Copyright © 2015 Cisin. All rights reserved.
 */

// @codingStandardsIgnoreFile

namespace Cisin\Enquiryform\Block\Adminhtml\Contactsitems\Edit\Tab;


use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;



class Main extends Generic implements TabInterface
{

    /**
     * {@inheritdoc}
     */
    public function getTabLabel()
    {
        return __('Contactsitems Information');
    }

    /**
     * {@inheritdoc}
     */
    public function getTabTitle()
    {
        return __('Contactsitems Information');
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
     * Prepare form before rendering HTML
     *
     * @return $this
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('current_cisin_enquiryform_contactsitems');
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('item_');
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Contactsitems Information')]);
        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }
        $fieldset->addField(
            'name',
            'text',
            ['name' => 'name', 'label' => __('Customer Name'), 'title' => __('Customer Name'), 'required' => true]
        );
        $fieldset->addField(
            'email',
            'text',
            ['name' => 'email', 'label' => __('Customer Email'), 'title' => __('Customer Email'), 'required' => true]
        );
        $fieldset->addField(
            'zipcode',
            'text',
            ['name' => 'email', 'label' => __('Zipcode'), 'title' => __('Zipcode')]
        );
        $fieldset->addField(
            'place',
            'text',
            ['name' => 'email', 'label' => __('Place'), 'title' => __('Place')]
        );
        $fieldset->addField(
            'topic',
            'text',
            ['name' => 'topic', 'label' => __('Topic'), 'title' => __('Topic')]
        );
        $fieldset->addField(
            'title',
            'text',
            ['name' => 'title', 'label' => __('Title'), 'title' => __('Title')]
        );
        $fieldset->addField(
            'phonenumber',
            'text',
            ['name' => 'phonenumber', 'label' => __('Phone Number'), 'title' => __('Phone Number')]
        );
        
         $fieldset->addField(
            'company',
            'text',
            ['name' => 'company', 'label' => __('Company'), 'title' => __('Company')]
        );
        $fieldset->addField(
            'comment',
            'textarea',
            ['name' => 'comment', 'label' => __('Comment'), 'title' => __('Comment')]
        );
        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
