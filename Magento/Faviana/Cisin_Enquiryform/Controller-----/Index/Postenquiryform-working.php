<?php 
namespace Cisin\Enquiryform\Controller\Index; 
 
class Postenquiryform extends \Magento\Framework\App\Action\Action {
    /** @var  \Magento\Framework\View\Result\Page */
    protected $resultPageFactory;
    /**      * @param \Magento\Framework\App\Action\Context $context      */
    public function __construct(\Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory)     {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
 
    /**
     * Blog Index, shows a list of recent blog posts.
     *
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
		
		        $post = $this->getRequest()->getPostValue();
        if (!$post) {
            $this->_redirect('*/*/');
            return;
        }

        
        try {
            $postObject = new \Magento\Framework\DataObject();
            $postObject->setData($post);

            $error = false;

            if (!\Zend_Validate::is(trim($post['name']), 'NotEmpty')) {
                $error = true;
            }
            
            if (!\Zend_Validate::is(trim($post['email']), 'EmailAddress')) {
                $error = true;
            }
            
            if ($error) {
                throw new \Exception();
            }

            $post = $this->getRequest()->getPostValue();
			$model = $this->_objectManager->create('Cisin\Enquiryform\Model\Items');
			$model->setData('name', $post['name']);
			
			$model->save();
           
            $this->messageManager->addSuccess(
                __('Thanks for send Enquiry us. We\'ll respond to you very soon.')
            );
            $this->_redirect('enquiryform/index');
            return;
        } catch (\Exception $e) {
            
            $this->messageManager->addError(
                __('We can\'t process your request right now. Sorry, that\'s all we know.')
            );
            $this->_redirect('enquiryform/index');
            return;
        }
		
    	//$resultPage = $this->resultPageFactory->create();
    	//$resultPage->getConfig()->getTitle()->prepend(__('Enquiryform'));
    	//return $resultPage;
    }
}