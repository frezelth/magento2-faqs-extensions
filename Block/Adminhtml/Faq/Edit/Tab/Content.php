<?php

/**
 *
 * @Author              Ngo Quang Cuong <bestearnmoney87@gmail.com>
 * @Date                2016-12-17 01:38:53
 * @Last modified by:   nquangcuong
 * @Last Modified time: 2016-12-17 04:26:14
 */

namespace PHPCuong\Faq\Block\Adminhtml\Faq\Edit\Tab;

class Content extends \Magento\Backend\Block\Widget\Form\Generic implements
    \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * Wysiwyg config
     *
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @var \Magento\Framework\View\Design\Theme\LabelFactory
     */
    protected $_themeLabelFactory;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Framework\View\Design\Theme\LabelFactory $themeLabelFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Framework\View\Design\Theme\LabelFactory $themeLabelFactory,
        array $data = []
    ) {
        $this->_wysiwygConfig            = $wysiwygConfig;
        $this->_themeLabelFactory        = $themeLabelFactory;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setActive(true);
    }

    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Content');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return $this->getTabLabel();
    }

    /**
     * Returns status flag about this tab can be showen or not
     *
     * @return true
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Returns status flag about this tab hidden or not
     *
     * @return true
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Prepare form before rendering HTML
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('Content')]
        );

        $this->_addElementTypes($fieldset);

        $fieldset->addField(
            'content',
            'editor',
            [
                'name' => 'content',
                'label' => __('FAQ Content'),
                'title' => __('FAQ Content'),
                'required' => true,
                'config'    => $this->_wysiwygConfig->getConfig()
            ]
        );

        $formData = $this->_coreRegistry->registry('phpcuong_faq');
        if ($formData) {
            $form->setValues($formData->getData());
        }

        $this->setForm($form);

        return parent::_prepareForm();
    }
}
