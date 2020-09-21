<?php


namespace Magenest\Luan\Controller\Index;


use Magenest\Luan\Model\ResourceModel\Hotel\CollectionFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Serialize\Serializer\Json;
class Retrieve extends Action
{
    protected $_collectionFactory, $json;

    public function __construct(Context $context, CollectionFactory $collectionFactory, Json $json)
    {
        parent::__construct($context);
        $this->_collectionFactory = $collectionFactory;
        $this->json = $json ?: \Magento\Framework\App\ObjectManager::getInstance()
            ->get(\Magento\Framework\Serialize\Serializer\Json::class);
    }

    public function execute()
    {
        $collection = $this->_collectionFactory->create();
        $data = $this->getRequest()->getParam('option');
        $response = $collection->addFieldToFilter('hotel_id',['eq',$data]);
        echo $this->json->serialize($response->getData());
    }
}
