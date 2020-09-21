<?php


namespace Magenest\PartTimePlus\Controller\Index;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory;
use Magento\Framework\Serialize\Serializer\Json;
class Replace extends Action
{
    protected $_collectionFactory;
    protected $json;
    public function __construct(Context $context, CollectionFactory $collectionFactory,Json $json)
    {
        parent::__construct($context);
        $this->_collectionFactory = $collectionFactory;
        $this->json = $json;
    }
    public function execute()
    {
        $data = [];
        $allCustomer = $this->_collectionFactory->create()->addAttributeToSelect('custom_prefix');
        foreach($allCustomer as $item){
            $data[] = [$item['entity_id'],$item['custom_prefix'], $item['firstname'] . $item['lastname'], $item['email']];
        }
        echo $this->json->serialize($data);
    }
}
