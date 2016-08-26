<?php

namespace Cis\Celebrity\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var PostDataProcessor
     */
    protected $dataProcessor;

    /**
     * @param Action\Context $context
     * @param PostDataProcessor $dataProcessor
     */
    public function __construct(Context $context, PostDataProcessor $dataProcessor)
    {
        $this->dataProcessor = $dataProcessor;
        parent::__construct($context);
    }
    
    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Cis_Celebrity::save');
    }

    /**
     * Save action
     *
     * @return void
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $data = $this->dataProcessor->filter($data);
            $model = $this->_objectManager->create('Cis\Celebrity\Model\Celebrity');

            $id = $this->getRequest()->getParam('celebrity_id');
            if ($id) {
                $model->load($id);
            }
            
            if($_FILES['image']['name']!=''){
                    $uploader = $this->_objectManager->create(
                        'Magento\MediaStorage\Model\File\Uploader',
                        ['fileId' => 'image']
                    );
                    $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png','pdf']);

                    /** @var \Magento\Framework\Image\Adapter\AdapterInterface $imageAdapter */
                    $imageAdapter = $this->_objectManager->get('Magento\Framework\Image\AdapterFactory')->create();

                    $uploader->setAllowRenameFiles(false);
                    $uploader->setFilesDispersion(false);

                    /** @var \Magento\Framework\Filesystem\Directory\Read $mediaDirectory */
                    $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')
                        ->getDirectoryRead(DirectoryList::MEDIA);
                    $result = $uploader->save(
                        $mediaDirectory->getAbsolutePath('Celebrity')
                    );
                    $data['image'] ='Celebrity/'.$result['file'];
            
            }
            else{
                if (isset($data['image']) && isset($data['image']['value'])) {
                        if (isset($data['image']['delete'])) {
                            $data['image'] = '';
                            $data['delete_image'] = true;
                            
                            $imageHelper = $this->_objectManager->get('Cis\Celebrity\Helper\Data');
                            if (isset($data['delete_image']) && $model->getImage()) {
                                $imageHelper->removeImage($model->getImage());
                                $model->setImage(null);
                            }
                        }else{
                            $data['image'] = $data['image']['value'];
                        }
                }
            }

            $model->addData($data);

            if (!$this->dataProcessor->validate($data)) {
                $this->_redirect('*/*/edit', ['celebrity_id' => $model->getId(), '_current' => true]);
                return;
            }

            try {
                $model->save();
                
                $this->messageManager->addSuccess(__('The Data has been saved.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', ['celebrity_id' => $model->getId(), '_current' => true]);
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (\Magento\Framework\Model\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }

            $this->_getSession()->setFormData($data);
            $this->_redirect('*/*/edit', ['celebrity_id' => $this->getRequest()->getParam('celebrity_id')]);
            return;
        }
        $this->_redirect('*/*/');
    }
}
