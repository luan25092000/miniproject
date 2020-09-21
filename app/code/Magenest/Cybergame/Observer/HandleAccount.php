<?php


namespace Magenest\Cybergame\Observer;


use Magenest\Cybergame\Model\GameAccountListFactory;
use Magenest\Cybergame\Model\ResourceModel\GameAccountList\CollectionFactory;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class HandleAccount implements ObserverInterface
{
    protected $_gameAccountListFactory, $_collectionFactory;

    public function __construct(GameAccountListFactory $gameAccountListFactory, CollectionFactory $_collectionFactory)
    {
        $this->_gameAccountListFactory = $gameAccountListFactory;
        $this->_collectionFactory = $_collectionFactory;
    }

    public function execute(Observer $observer)
    {
        $model = $this->_gameAccountListFactory->create();
        $collection = $this->_collectionFactory->create();
        $array = $observer->getEvent()->getOrder()->getData();
        foreach ($array['items'] as $item) {
            $data = $item->getData();
            // Get account name
            $accountName = $data["product_options"]['info_buyRequest']['account_guest'];
            $isAccount = $collection->addFieldToFilter('account_name', $accountName);
            if(empty($isAccount->getData())){
                $model->setData('product_id', $item['product_id']);
                $model->setData('account_name', $accountName);
                $model->setData('password', 1);
                $model->setData('hour', $item['qty_ordered']);
                $model->save();
            }
            else{
                foreach ($collection->getData() as $account) {
                    //Compare account name with account_name in table in database
                    if ($account['account_name'] !== $accountName || $account['product_id']!==$item['product_id']) {
                        $model->setData('product_id', $item['product_id']);
                        $model->setData('account_name', $accountName);
                        $model->setData('password', 1);
                        $model->setData('hour', $item['qty_ordered']);
                        $model->save();
                    } else {
                        $collection->addFieldToFilter('account_name', $accountName);
                        foreach($collection->getData() as $value){
                            $model->load($value['id']);
                            $currentHour = $model->getData('hour');
                            $model->setData('hour', $currentHour + $item['qty_ordered']);
                            $model->save();
                        }
                    }
                }
            }
        }
    }
}
