<?php


namespace Magenest\PartTimePlus\Block;


use Magento\Framework\View\Element\Template;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
class Order extends Template
{
    protected $_orderCollectionFactory;
    public function __construct(Template\Context $context,
                                CollectionFactory $orderCollectionFactory,
                                array $data = [])
    {
        parent::__construct($context, $data);
        $this->_orderCollectionFactory = $orderCollectionFactory;
    }
   public function showOrderId(){
        $order = $this->_orderCollectionFactory->create();
        $orderId = [];
        foreach($order->getData() as $item){
            $orderId[] = $item['entity_id'];
       }
        return $orderId;
   }
}
