<?php


namespace Magenest\Staff\Controller\Adminhtml\Index;


use Magenest\Staff\Model\StaffFactory;
use Magenest\Staff\Model\ResourceModel\Staff\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;

class Delete extends \Magento\Backend\App\Action
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
        $staffDeleted = 0;
        try {
            $collection = $this->_filter->getCollection($this->_collectionFactory->create());
            foreach ($collection->getItems() as $item) {
                $resultStaff = $this->_modelFactory->create()->load($item->getData('id'));
                $resultStaff->delete();
                $staffDeleted++;
            }
        } catch (LocalizedException $e) {
            throwException($e);
        }
        if ($staffDeleted) {
            $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $staffDeleted));
        }
        $this->_redirect('*/*/display');
    }
}
