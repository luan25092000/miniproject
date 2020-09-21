<?php


namespace Magenest\Staff\Controller\Adminhtml\Index;


use Magenest\Staff\Model\ResourceModel\Staff\CollectionFactory;
use Magenest\Staff\Model\StaffFactory;
use Magento\Backend\App\Action;
use Magento\Ui\Component\MassAction\Filter;

class Change extends Action
{
    protected $_collectionFactory, $_modelFactory, $_filter;

    public function __construct(Action\Context $context, StaffFactory $modelFactory, CollectionFactory $collectionFactory, Filter $filter)
    {
        $this->_modelFactory = $modelFactory;
        $this->_collectionFactory = $collectionFactory;
        $this->_filter = $filter;
        parent::__construct($context);
    }

    public function execute()
    {
        $collection = $this->_filter->getCollection($this->_collectionFactory->create());
        foreach ($collection->getItems() as $item) {
            $resultStaff = $this->_modelFactory->create()->load($item->getData('id'));
            if ($resultStaff->getData('status') === "2") {
                $resultStaff->setData('status', "1");
            } elseif ($resultStaff->getData('type') === "1") {
                $resultStaff->setData('status', "2");
            }
        }
        $resultStaff->save();
        $this->messageManager->addSuccessMessage(__('Successful to change status.'));
        $this->_redirect('*/*/display');
    }
}
