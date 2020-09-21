<?php


namespace Magenest\Notification\Controller\Index;


use Magenest\Notification\Model\NotificationFactory;
use Magento\Customer\Model\CustomerFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Http\Context as AuthContext;

class Delete extends Action
{
    protected $_notificationFactory;
    protected $_authContext;
    protected $_customerSession;
    protected $_customerFactory;

    public function __construct(Context $context,
                                NotificationFactory $notificationFactory,
                                AuthContext $authContext,
                                Session $customerSession,
                                CustomerFactory $customerFactory)
    {
        $this->_notificationFactory = $notificationFactory;
        $this->_authContext = $authContext;
        $this->_customerSession = $customerSession;
        $this->_customerFactory = $customerFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        //Xóa trong bảng
        $customerId = $this->getRequest()->getParam('id');
        $notification = $this->_notificationFactory->create();
        $notification->load($customerId);
        //Xóa customer attribute
        $isLoggedIn = $this->_authContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
        $customer = $this->_customerFactory->create();
        if ($isLoggedIn) {
            $customerLogginId = $this->_customerSession->getCustomer()->getId();
        }
        $customer->load($customerLogginId);
        $array = explode(',', $customer->getData('notification_received'));
        for ($i = 0; $i < count($array); $i++) {
            if($customerId===$array[$i]){
                unset($array[$i]);
            }
        }
        $customer->setData('notification_received',implode(',',$array));
        $customer->save();
        $notification->delete();
        $this->messageManager->addSuccessMessage(__('Successful to delete notification'));
        $this->_redirect("http://nhlmg.com/notification/customer/index/");
    }
}
