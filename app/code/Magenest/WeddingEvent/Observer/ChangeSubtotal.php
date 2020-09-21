<?php


namespace Magenest\WeddingEvent\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class ChangeSubtotal implements ObserverInterface
{
    protected $_quoteItemFactory, $_collectionFactory;
    public function __construct(\Magento\Quote\Model\Quote\ItemFactory $quoteItemFactory,
\Magento\Quote\Model\ResourceModel\Quote\Item\CollectionFactory $collectionFactory)
    {
        $this->_quoteItemFactory = $quoteItemFactory;
        $this->_collectionFactory = $collectionFactory;
    }
    public function execute(Observer $observer)
    {
        $data = $observer->getData();
        $quoteItem = $this->_quoteItemFactory->create();
        $quoteCollection = $this->_collectionFactory->create();
        $quoteCollection->addFieldToFilter('product_id',$data['1']);
        foreach ($quoteCollection->getData() as $item){
            $itemId = $item['$item_id'];
        }
        $quoteItem->load($itemId);
        $quoteItem->setData('price',$data['0']);
        $quoteItem->setData('base_price',$data['0']);
        $quoteItem->save();
    }
}
