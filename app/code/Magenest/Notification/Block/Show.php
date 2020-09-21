<?php


namespace Magenest\Notification\Block;

use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Http\Context as AuthContext;
use Magento\Framework\View\Element\Template;

class Show extends Template
{
    protected $_collectionFactory;
    protected $_authContext;
    protected $_customerSession;

    public function __construct(Template\Context $context,
                                CollectionFactory $collectionFactory,
                                AuthContext $authContext,
                                Session $customerSession,
                                array $data = [])
    {
        $this->_collectionFactory = $collectionFactory;
        $this->_customerSession = $customerSession;
        $this->_authContext = $authContext;
        parent::__construct($context, $data);
    }

    public function showNotification()
    {
        $isLoggedIn = $this->_authContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
        $customer = $this->_collectionFactory->create();
        if ($isLoggedIn) {
            $customerId = $this->_customerSession->getCustomer()->getId();
            $data = $customer->addFieldToFilter('entity_id', $customerId);
            $array = $data->addAttributeToSelect('notification_received');
        }
        foreach($array as $item) {
           $value  = explode(',',$item->getData('notification_received'));
        }
        return $value;
    }
}
