<?php


namespace Magenest\Notification\Model\Config\Source;


use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
class Options  extends AbstractSource
{
    protected $options = [];
    public function __construct(){
        $this->step = 0;
    }
    public function getAllOptions()
    {
        if($this->step ==0){
            $this->step = 1;
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $productCollection = $objectManager->create('Magenest\Notification\Model\ResourceModel\Notification\Collection');
            $notificationReceived = $productCollection->addFieldToFilter('status','enable');
            foreach($notificationReceived->getData() as $item){
                $this->options[] = ["label" => $item['name'], "value" => $item['entity_id']];
            }
            return $this->options;
        }
    }
}
