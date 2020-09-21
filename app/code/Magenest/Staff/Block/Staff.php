<?php

namespace Magenest\Staff\Block;

use Magenest\Staff\Model\ResourceModel\Staff\CollectionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\App\Http\Context as AuthContext;
class Staff extends Template
{
    protected $_collectionFactory, $_authContext;

    public function __construct(Template\Context $context,
                                CollectionFactory $collectionFactory,
                                AuthContext $authContext,array $data = [])
    {
        $this->_collectionFactory = $collectionFactory;
        $this->_authContext = $authContext;
        parent::__construct($context, $data);
    }

    public function getNickName()
    {
        $objectmanager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectmanager->create('Magento\Customer\Model\Session');
        $isLoggedIn = $this->_authContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
        $customer = $this->_collectionFactory->create();
        if ($isLoggedIn) {
            $customerId = $customerSession->getCustomer()->getId();
        }
         $customer->addFieldToFilter('customer_id',$customerId);
        foreach($customer->getData() as $item){
            $name = $item['nick_name'];
        }
        return $name;
    }
}
