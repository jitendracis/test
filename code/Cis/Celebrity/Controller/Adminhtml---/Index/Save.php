<?php

namespace Cis\Celebrity\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\UrlInterface;
use Magento\Framework\Filesystem;

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
    public function __construct(Action\Context $context, PostDataProcessor $dataProcessor, \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory)
    {
        $this->dataProcessor = $dataProcessor;
        $this->uploaderFactory = $fileUploaderFactory;
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
            
            if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
                $data['image'] = $_FILES['image']['name'];
            }
            
            
            // save image data and remove from data array
            if (isset($data['image'])) {
                $imageData['image'] = $data['image'];
                unset($data['image']);
            } else {
                $imageData = array();
            }
            
            $model->addData($data);

            if (!$this->dataProcessor->validate($data)) {
                $this->_redirect('*/*/edit', ['celebrity_id' => $model->getId(), '_current' => true]);
                return;
            }

            try {
                
                $imageName = $this->uploadFileAndGetName('input_name', $this->fileSystem->getDirectoryWrite(DirectoryList::MEDIA)->getAbsolutePath($subdir_of_your_choice.'/image'));
                $your_model->setImage($imageName);
                
                $imageHelper = $this->_objectManager->get('Cis\Celebrity\Helper\Data');
                //
                echo $imageData['image'];
                print_r($imageData); 
                
                if (isset($imageData['delete']) && $model->getImage()) {
                    $imageHelper->removeImage($model->getImage());
                    $model->setImage(null);
                }
                
                if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
                    $uploader = $this->_fileUploaderFactory->create(['fileId' => $scope]);
                    $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                    $uploader->setAllowRenameFiles(true);
                    $uploader->setFilesDispersion(false);
                    $uploader->setAllowCreateFolders(true);
                    if ($uploader->save($this->getBaseDir())) {
                        return $uploader->getUploadedFileName();
                    }
                    
                die("852741");    
                    
                    //$imageHelper->uploadImage($imageData['image']);
                    $model->setImage($_FILES['filename']['name']);
                }
                
                die("****");
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
