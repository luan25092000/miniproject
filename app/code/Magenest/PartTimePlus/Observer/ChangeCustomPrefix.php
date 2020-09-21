<?php


namespace Magenest\PartTimePlus\Observer;


use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class ChangeCustomPrefix implements ObserverInterface
{
    protected $_customerFactory;

    public function __construct(CustomerFactory $customerFactory)
    {
        $this->_customerFactory = $customerFactory;
    }

    public function execute(Observer $observer)
    {
        $customer = $this->_customerFactory->create();
        $firstName = $observer->getEvent()->getCustomer()->getData('firstname');
        $customerId = $observer->getEvent()->getCustomer()->getData('entity_id');
        $customer->load($customerId);
        $customer->setData('custom_prefix', strlen($firstName));
        $customer->save();
    }
}
