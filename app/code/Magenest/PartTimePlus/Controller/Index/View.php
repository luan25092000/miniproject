<?php


namespace Magenest\PartTimePlus\Controller\Index;


use Magento\Customer\Model\CustomerFactory;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Http\Context as AuthContext;
use Magento\Framework\Serialize\Serializer\Json;

class View extends Action
{
    protected $_collectionFactory;
    protected $_customerSession;
    protected $authContext;
    protected $_customerFactory;
    protected $_json;

    public function __construct(Context $context,
                                CollectionFactory $collectionFactory,
                                \Magento\Customer\Model\Session $customerSession,
                                AuthContext $authContext,
                                CustomerFactory $customerFactory,
                                Json $json)
    {
        $this->_collectionFactory = $collectionFactory;
        $this->_customerSession = $customerSession;
        $this->authContext = $authContext;
        $this->_customerFactory = $customerFactory;
        $this->_json = $json;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = [];
        $customCheck = $this->_customerFactory->create();
        $isLoggedIn = $this->authContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
        if ($isLoggedIn) {
            $customerId = $this->_customerSession->getId();
        }
        $customPrefix = $customCheck->load($customerId);
        $customer = $this->_collectionFactory->create()->addAttributeToSelect('custom_prefix');
        foreach ($customer as $item) {
            if ($customPrefix['custom_prefix'] === $item['custom_prefix']) {
                $data[] = [$item['entity_id'], $item['custom_prefix'], $item['firstname'] . $item['lastname'], $item['email']];
            }
        }
        echo $this->_json->serialize($data);
    }
}
