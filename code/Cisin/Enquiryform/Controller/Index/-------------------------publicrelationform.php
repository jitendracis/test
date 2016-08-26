<?php 

namespace Cisin\Enquiryform\Controller\Index; 
 
class Publicrelationform extends \Magento\Framework\App\Action\Action {
    
      /**
          * Recipient email config path
      */
      const XML_PATH_EMAIL_RECIPIENT = 'contact/email/recipient_email'; 
      /**
      * @var \Magento\Framework\Mail\Template\TransportBuilder
      */
      protected $_transportBuilder;

      /**
      * @var \Magento\Framework\Translate\Inline\StateInterface
      */
      protected $inlineTranslation;

      /**
      * @var \Magento\Framework\App\Config\ScopeConfigInterface
      */
      protected $scopeConfig;

      /**
      * @var \Magento\Store\Model\StoreManagerInterface
      */
      protected $storeManager; 
      /**
      * @var \Magento\Framework\Escaper
      */
      protected $_escaper;
      /**
      * @param \Magento\Framework\App\Action\Context $context
      * @param \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder
      * @param \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation
      * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
      * @param \Magento\Store\Model\StoreManagerInterface $storeManager
      */
      public function __construct(
      \Magento\Framework\App\Action\Context $context,
      \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
      \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
      \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
      \Magento\Store\Model\StoreManagerInterface $storeManager,
      \Magento\Framework\Escaper $escaper
      ) {
            parent::__construct($context);
            $this->_transportBuilder = $transportBuilder;
            $this->inlineTranslation = $inlineTranslation;
            $this->scopeConfig = $scopeConfig;
            $this->storeManager = $storeManager;
            $this->_escaper = $escaper;
      }

      /**
      * Post user question
      *
      * @return void
      * @throws \Exception
      */
      public function execute()
      {
        
            $post = $this->getRequest()->getPostValue();
            

            if (!$post) {
            $this->messageManager->addError(__('PLease Add data first'));
            $this->_redirect('*/*/');
            return;
            }
            else
            {
                          $name      = $post["name"];
                                    $email     = $post["email"];
                                    $name      = $post["name"];
                                    $phoneno   = $post["phoneno"];
                                    $country   = $post["country"];
                                    $city      = $post["city"];
                                    $comment   = $post["comment"];
                                 //    echo $str = "Hello $email Your details is=
                                 //                 name           =   $name
                                 //                 email          =   $email
                                 //                 phoneno        =   $phoneno
                                 //                 country        =   $country
                                 //                 city           =   $city
                                 //                 comment        =   $comment ";
                                 // mail($email, 'Details', $str);
                                 // $this->messageManager->addSuccess(__('Your data add successfully'));
                                 // $this->_redirect('*/*/');    

            $this->inlineTranslation->suspend();
            try {
                  
                  $postObject = new \Magento\Framework\DataObject();
                  $postObject->setData($post);
                  

                                   // $cuurl=$post['cuurl'];
                  /*save data*/
                  // $model = $this->_objectManager->create('Cisin\Enquiryform\Model\Items');
                  // $model->setData('name', $name);
                  // $model->setData('email', $email);
                  // $model->setData('phoneno', $phoneno);
                  // $model->setData('iam', $iam);
                  // $model->setData('dress', $dress);
                  // $model->setData('stylenumber',$stylenumber);
                  // $model->setData('color',$color);
                  // $model->setData('size', $size);
                  // $model->setData('birthday', $birthday);
                  // $model->setData('apporixmatedate', $apporixmatedate);
                  // $model->setData('location',  $location);
                  // $model->setData('comment',  $comment);
                  // $model->save();
                  /*save data*/
                   
                  $error = false;
                  
                  
                  $sender = [
                  'name' => $this->_escaper->escapeHtml($post['name']),
                  'email' => $this->_escaper->escapeHtml($email),
                  ];
                  
                  $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE; 
                  
                  $transport = $this->_transportBuilder
                              ->setTemplateIdentifier('send_email_email_template1') // this code we have mentioned in the email_templates.xml
                              ->setTemplateOptions(
                        [
                              'area' => \Magento\Framework\App\Area::AREA_FRONTEND, // this is using frontend area to get the template file
                              'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                        ]
                             )
                  ->setTemplateVars(['data' => $postObject])
                  ->setFrom($sender)
                  //->addTo($this->scopeConfig->getValue(self::XML_PATH_EMAIL_RECIPIENT, $storeScope))
                  ->addTo('pooja.p@cisinlabs.com')
                  
                  ->getTransport();
                  
                  

                  $transport->sendMessage(); 
                  $this->inlineTranslation->resume();
                  $this->messageManager->addSuccess(__('Thanks for contacting us with your comments and questions. We\'ll respond to you very soon.'));
                  // $this->_redirect($cuurl);
                  return;
                  }
            catch (\Exception $e) {
                  $this->inlineTranslation->resume();
                  $this->messageManager->addError(__('We can\'t process your request right now. Sorry, that\'s all we know.'.$e->getMessage()));
                  // $this->_redirect($cuurl);
                  return;
            }              


              }

            // $this->inlineTranslation->suspend();
            // try {
                  
            //      $postObject = new \Magento\Framework\DataObject();
            //      $postObject->setData($post);
                  
                  
      //                              $cuurl=$post['cuurl'];
            //      /*save data*/
            //      $model = $this->_objectManager->create('Cisin\Enquiryform\Model\Items');
            //      $model->setData('name', $post['name']);
            //      $model->setData('qty', $post['qty']);
            //      $model->setData('company', $post['company']);
            //      $model->setData('job', $post['job']);
            //      $model->setData('email', $post['email']);
            //      $model->setData('comment', $post['comment']);
            //      $model->setData('phone_number', $post['telephone']);
            //      $model->setData('product_id', $post['pid']);
            //      $model->setData('product_name', $post['pname']);
            //      $model->setData('zipcode', $post['zipcode']);
            //      $model->setData('place', $post['place']);
            //      $model->save();
            //      /*save data*/
                   
            //      $error = false;
                  
                  
            //      $sender = [
            //      'name' => $this->_escaper->escapeHtml($post['name']),
            //      'email' => $this->_escaper->escapeHtml($post['email']),
            //      ];
                  
            //      $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE; 
                  
            //      $transport = $this->_transportBuilder
            //                  ->setTemplateIdentifier('send_email_email_template') // this code we have mentioned in the email_templates.xml
            //                  ->setTemplateOptions(
            //            [
            //                  'area' => \Magento\Framework\App\Area::AREA_FRONTEND, // this is using frontend area to get the template file
            //                  'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
            //            ]
            //                 )
            //      ->setTemplateVars(['data' => $postObject])
            //      ->setFrom($sender)
            //      //->addTo($this->scopeConfig->getValue(self::XML_PATH_EMAIL_RECIPIENT, $storeScope))
            //      ->addTo('verkoop@bergo.nl')
                  
            //      ->getTransport();
                  
                  

            //      $transport->sendMessage(); ;
            //      $this->inlineTranslation->resume();
            //      $this->messageManager->addSuccess(__('Thanks for contacting us with your comments and questions. We\'ll respond to you very soon.'));
            //      $this->_redirect($cuurl);
            //      return;
            //      }
            // catch (\Exception $e) {
            //      $this->inlineTranslation->resume();
            //      $this->messageManager->addError(__('We can\'t process your request right now. Sorry, that\'s all we know.'.$e->getMessage()));
            //      $this->_redirect($cuurl);
            //      return;
            // }
}
}