<?php

namespace Cis\Celebritycategory\Controller\AbstractController;

use Magento\Framework\App\Action;
use Magento\Framework\View\Result\PageFactory;

abstract class View extends Action\Action
{
    /**
     * @var \Cis\Celebritycategory\Controller\AbstractController\CelebritycategoryLoaderInterface
     */
    protected $celebritycategoryLoader;
	
	/**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Action\Context $context
     * @param OrderLoaderInterface $orderLoader
	 * @param PageFactory $resultPageFactory
     */
    public function __construct(Action\Context $context, CelebritycategoryLoaderInterface $celebritycategoryLoader, PageFactory $resultPageFactory)
    {
        $this->celebritycategoryLoader = $celebritycategoryLoader;
		$this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Celebritycategory view page
     *
     * @return void
     */
    public function execute()
    {
        if (!$this->celebritycategoryLoader->load($this->_request, $this->_response)) {
            return;
        }

        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
		return $resultPage;
    }
}
