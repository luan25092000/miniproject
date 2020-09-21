<?php


namespace Magenest\Notification\Controller\Index;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magenest\Notification\Model\NotificationFactory;
class Retrieve extends Action
{
    protected $_notificationFactory;
    public function __construct(Context $context, NotificationFactory $notificationFactory)
    {
        $this->_notificationFactory  =$notificationFactory;
        parent::__construct($context);
    }
    public function execute()
    {
//        $customerId = $this->getRequest()->getParam('id');
        $customerId = $this->getRequest()->getParam('id');
        $notification = $this->_notificationFactory->create();
        $notification->load($customerId);
        $notification->setData('status','disable');
        $notification->save();
        $this->_redirect("http://nhlmg.com/notification/customer/index/");
    }
}
