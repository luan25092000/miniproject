<?php


namespace Magenest\Staff\Controller\Index;


use Magenest\Staff\Model\ResourceModel\Staff\CollectionFactory;
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
        $this->json = $json;
    }

    public function execute()
    {
        $data = [];
        $name = $this->getRequest()->getParam('name');
        $collection = $this->_collectionFactory->create()->addFieldToFilter('nick_name', array('like' => '%'.$name.'%'));
        foreach($collection->getData() as $item){
            $data[] = $item['nick_name'];
        }
        echo $this->json->serialize($data);
    }
}
