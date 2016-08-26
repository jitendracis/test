<?php

namespace Cis\Celebritycategory\Model;

class Celebritycategory extends \Magento\Framework\Model\AbstractModel
{ 
    protected $request;
    
    public function _construct()
    {
        $this->_init('Cis\Celebritycategory\Model\ResourceModel\Celebritycategory');
    }
    
    public function toOptionArray($currentId)
    {
        $objectManager =   \Magento\Framework\App\ObjectManager::getInstance();
        $connection = $objectManager->get('Magento\Framework\App\ResourceConnection')->getConnection('\Magento\Framework\App\ResourceConnection::DEFAULT_CONNECTION'); 
        $qryStr = 'SELECT celebritycategory_id, title FROM cis_celebritycategory where categoryChild != 1';
        if(!empty($currentId)){
            $qryStr .= ' and celebritycategory_id != '.$currentId;
        }
        $results = $connection->fetchAll($qryStr);

        $option[] = [
            'value' => '',
            'label' => __('--Please select a Parent Category--'),
        ];
        foreach($results as $result){
            $option[] = [
                'value' => $result['celebritycategory_id'],
                'label' => $result['title'],
            ];
        }
        return $option;
    }

}

