<?php


namespace Magenest\Notification\Controller\Index;


use Magento\Customer\Model\CustomerFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Http\Context as AuthContext;

class Count extends Action
{
    protected $_authContext;
    protected $_customerSession;
    protected $_customerFactory;

    public function __construct(Context $context,
                                AuthContext $authContext,
                                Session $customerSession,
                                CustomerFactory $customerFactory
    )
    {
        $this->_customerSession = $customerSession;
        $this->_authContext = $authContext;
        $this->_customerFactory = $customerFactory;
        parent::__construct($context);
    }

    public
    function execute()
    {
        $isLoggedIn = $this->_authContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
        $customer = $this->_customerFactory->create();
        if ($isLoggedIn) {
            $customerId = $this->_customerSession->getCustomer()->getId();
        }
        $customer->load($customerId);
        echo count(explode(',',$customer->getData('notification_received')));
    }
}
