<?php


namespace Magenest\Cybergame\Block;


use Magento\Framework\View\Element\Template;
use Magenest\Cybergame\Model\ResourceModel\RoomExtraOption\CollectionFactory;
use Magento\Customer\Model\CustomerFactory;
class Show extends Template
{
    protected $_collectionFactory, $_customerFactory, $_customerSession;
    public function __construct(Template\Context $context,
                                CollectionFactory $collectionFactory,
                                CustomerFactory $customerFactory,
                                \Magento\Customer\Model\Session $customerSession,
                                array $data = [])
    {
        $this->_collectionFactory = $collectionFactory;
        $this->_customerFactory = $customerFactory;
        $this->_customerSession = $customerSession;
        parent::__construct($context, $data);
    }
    public function show(){
        $collection = $this->_collectionFactory->create();
        $data = $collection->getData();
        return $data;
    }
    public function disabled(){
        $model = $this->_customerFactory->create();
        $customerId = $this->_customerSession->getCustomerId();
        $model->load($customerId);
        if($model->getData('is_manager')==1){
            return true;
        }
        elseif($model->getData('is_manager')==0){
            return false;
        }
    }
}
