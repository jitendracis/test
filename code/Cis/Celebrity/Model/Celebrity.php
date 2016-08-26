<?php

namespace Cis\Celebrity\Model;

/**
 * Celebrity Model
 *
 * @method \Cis\Celebrity\Model\Resource\Page _getResource()
 * @method \Cis\Celebrity\Model\Resource\Page getResource()
 */
class Celebrity extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Cis\Celebrity\Model\ResourceModel\Celebrity');
    }

    public function toCatOptionArray()
    {
        $objectManager =   \Magento\Framework\App\ObjectManager::getInstance();
        $connection = $objectManager->get('Magento\Framework\App\ResourceConnection')->getConnection('\Magento\Framework\App\ResourceConnection::DEFAULT_CONNECTION'); 
        $qryStr = 'SELECT celebritycategory_id, title FROM cis_celebritycategory Where categoryChild = 1';        
        $results = $connection->fetchAll($qryStr);

        $option[] = [
            'value' => '',
            'label' => __('--Please select Category--'),
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
