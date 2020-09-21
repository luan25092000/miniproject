<?php


namespace Magenest\Cybergame\Observer;


use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class EnableToEdit implements ObserverInterface
{
    protected $_customerFactory, $_customerSession;

    public function __construct(
       CustomerFactory $customerFactory,\Magento\Customer\Model\Session $customerSession
    )
    {
        $this->_customerFactory = $customerFactory;
        $this->_customerSession = $customerSession;
    }

    public function execute(Observer $observer)
    {
        $customerId = $this->_customerSession->getCustomer()->getId();
        $model = $this->_customerFactory->create();
        $model->load($customerId);
        if($_POST['cyber_manager']==='on'){
            $model->setData('is_manager',1);
        }
        else{
            $model->setData('is_manager',1);
        }
        $model->save();
    }
}
