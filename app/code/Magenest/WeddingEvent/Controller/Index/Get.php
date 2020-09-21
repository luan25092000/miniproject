<?php

namespace Magenest\WeddingEvent\Controller\Index;

use Magenest\WeddingEvent\Model\ResourceModel\Wedding\CollectionFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Serialize\Serializer\Json;
class Get extends Action
{
    protected $_collectionFactory, $_json;
    public function __construct(Context $context,
                                CollectionFactory  $collectionFactory, Json $json)
    {
        $this->_collectionFactory = $collectionFactory;
        $this->_json = $json ?: \Magento\Framework\App\ObjectManager::getInstance()
            ->get(\Magento\Framework\Serialize\Serializer\Json::class);
        parent::__construct($context);
    }

    public function execute()
    {
        $collection = $this->_collectionFactory->create();
        $brideEmail = $this->getRequest()->getParam('bride');
        $groomEmail = $this->getRequest()->getParam('groom');
        $collection->addFieldToFilter('bride_email',$brideEmail);
        $collection->addFieldToFilter('groom_email',$groomEmail);
        echo $this->_json->serialize($collection->getData());
    }
}
