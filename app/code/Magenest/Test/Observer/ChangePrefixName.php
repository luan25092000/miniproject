<?php


namespace Magenest\Test\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magenest\Test\Model\TestFactory;
class ChangePrefixName implements ObserverInterface
{
    protected $_testFactory;
    public function __construct(TestFactory $testFactory)
    {
        $this->_testFactory = $testFactory;
    }
    public function execute(Observer $observer)
    {
        $model = $this->_testFactory->create();
        $country = $observer->getData('country');
        if($country==='Vietnam'){
            $model->setData('prefix','Viet');
        }
        elseif($country==='United State'){
            $model->setData('prefix','State');
        }
        elseif($country==='United Kingdom'){
            $model->setData('prefix','Kingdom');
        }
        elseif($country==='China'){
            $model->setData('prefix','Chi');
        }
        else{
            $model->setData('prefix','Other');
        }
        $model->save();
    }
}
