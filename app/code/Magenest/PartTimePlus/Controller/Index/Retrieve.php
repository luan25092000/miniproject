<?php


namespace Magenest\PartTimePlus\Controller\Index;


use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Serialize\Serializer\Json;

class Retrieve extends Action
{
    protected $_collectionFactory, $_json;

    public function __construct(Context $context,
                                CollectionFactory $collectionFactory,
                                Json $json)
    {
        parent::__construct($context);
        $this->_collectionFactory = $collectionFactory;
        $this->_json = $json;
    }

    public function execute()
    {
        $questions = [];
        $orderId = $this->getRequest()->getParam('option');
        $product = $this->_collectionFactory->create()->addAttributeToSelect('question')->addAttributeToFilter('question', array('like' => $orderId . '%'));
        foreach ($product as $item) {
            $questions[] = $item['question'];
        }
        echo $this->_json->serialize($questions);
    }
}
