<?php


namespace Magenest\Staff\Controller\Index;


use Magenest\Staff\Model\ResourceModel\Staff\CollectionFactory;
use Magenest\Staff\Model\StaffFactory;
use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\App\Http\Context as AuthContext;
class Save extends Action
{
    protected $_staffFactory;
    protected $_collectionFactory;
    protected $_customerFactory;
    protected $json;
    protected $_authContext;

    public function __construct(
        Context $context,
        StaffFactory $staffFactory,
        CollectionFactory $collectionFactory,
        CustomerFactory $customerFactory,
        Json $json,
        AuthContext $authContext
)
    {
        $this->_staffFactory = $staffFactory;
        $this->_customerFactory = $customerFactory;
        $this->_collectionFactory = $collectionFactory;
        $this->json = $json ?: \Magento\Framework\App\ObjectManager::getInstance()
            ->get(\Magento\Framework\Serialize\Serializer\Json::class);
        $this->_authContext = $authContext;
        parent::__construct($context);
    }

    public function execute()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->create('Magento\Customer\Model\Session');
        $isLoggedIn = $this->_authContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
        if($isLoggedIn){
            $customerId = $customerSession->getCustomer()->getId(); // Get current customer id
        }
        $selectedLevel = $this->getRequest()->getParam('level');
        $nickName = $this->getRequest()->getParam('nickName');
        $staff = $this->_staffFactory->create();
        $customer = $this->_customerFactory->create();
        //save type table
        $customerFilter = $this->_collectionFactory->create()->addFieldToFilter('customer_id', $customerId);
        foreach($customerFilter->getData() as $item){
            $id = $item['id'];
        }
        $staff->load($id);
        $staff->setData('type', $selectedLevel);
        $staff->setData('nick_name',$nickName);
        $staff->save();
        //save customer attribute
        $customer->load($customerId);
        $customer->setData('staff_type',$selectedLevel);
        $customer->save();
        echo $this->json->serialize($nickName);
    }
}
