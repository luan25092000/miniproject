<?php


namespace Magenest\Cybergame\Controller\Account;


use Magento\Framework\App\Action\Context;
use Magenest\Cybergame\Model\ResourceModel\GameAccountList\CollectionFactory;
use Magento\Framework\Serialize\Serializer\Json;
class Check extends \Magento\Framework\App\Action\Action
{
    protected $_collectionFactory, $_json;
    public function __construct(Context $context, CollectionFactory $collectionFactory, Json $json)
    {
        parent::__construct($context);
        $this->_collectionFactory = $collectionFactory;
        $this->_json = $json ?: \Magento\Framework\App\ObjectManager::getInstance()
            ->get(\Magento\Framework\Serialize\Serializer\Json::class);
    }
    public function execute()
    {
        $accountName = $this->getRequest()->getParam('name');
        $collection = $this->_collectionFactory->create();
        foreach($collection->getData() as $item){
            if($item['account_name']===$accountName){
                echo true;
            }
            else{
                echo false;
            }
        }
    }
}
