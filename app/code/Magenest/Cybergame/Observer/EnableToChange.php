<?php


namespace Magenest\Cybergame\Observer;


use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class EnableToChange implements ObserverInterface
{
    protected $_customerRepositoryInterface, $_customerFactory;

    public function __construct(
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface, CustomerFactory $customerFactory
    )
    {
        $this->_customerRepositoryInterface = $customerRepositoryInterface;
        $this->_customerFactory = $customerFactory;
    }

    public function execute(Observer $observer)
    {
        $model = $this->_customerFactory->create();
        $customerId = $observer->getCustomer()->getId();
        $customerAtt = $this->_customerRepositoryInterface->getById($customerId);
        $customerAttValue = $customerAtt->getCustomAttribute('is_manager');
        $model->load($customerId);
        if($_POST['cyber_manager']==='on'){
            $model->setData($customerAttValue->getAttributeCode(),1);
        }
        else{
            $model->setData($customerAttValue->getAttributeCode(),1);
        }
        $model->save();
    }
}
