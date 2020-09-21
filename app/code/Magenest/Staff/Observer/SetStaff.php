<?php


namespace Magenest\Staff\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magenest\Staff\Model\StaffFactory;
class SetStaff implements ObserverInterface
{
    protected $_staffFactory;
    protected $responseFactory;
    protected $url;
    protected $step;
    public function __construct(StaffFactory $staffFactory){
        $this->_staffFactory = $staffFactory;
        $this->step = 0;
    }
    public function execute(Observer $observer)
    {
        if($this->step == 0){
            $staff = $this->_staffFactory->create();
            $data = $observer->getEvent()->getCustomer()->getData();
            $staff->setData('customer_id',$data['entity_id']);
            $staff->setData('status','2');
            $staff->setData('nick_name',$data['firstname']." ".$data['lastname']);
            $staff->setData('type',$data['staff_type']);
            $staff->save();
            $this->step = 1;
        }

    }
}
