<?php
namespace Cisin\Enquiryform\Block;

class Enquiryform extends \Magento\Framework\View\Element\Template
{
    
    protected function _prepareLayout()
    {
 
    }
    
    public function getPosts()
    {
        // Check if posts has already been defined
        // makes our block nice and re-usable! We could
        // pass the 'posts' data to this block, with a collection
        // that has been filtered differently!
        if (!$this->hasData('posts')) {
            $posts = $this->_postCollectionFactory
                ->create();
                
            $this->setData('posts', $posts);
        }
        return $this->getData('posts');
    }
    
     public function getFormAction()
    {
        return $this->getUrl('enquiryform/index/postenquiryform', ['_secure' => true]);
    }
    public function getEnquiryFormAction()
    {
        return $this->getUrl('enquiryform/index/postnewenquiryform', ['_secure' => true]);
    }
}
?>