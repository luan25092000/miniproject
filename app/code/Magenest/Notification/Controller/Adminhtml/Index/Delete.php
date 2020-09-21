<?php


namespace Magenest\Notification\Controller\Adminhtml\Index;


use Magenest\Notification\Model\NotificationFactory;
use Magenest\Notification\Model\ResourceModel\Notification\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;

class Delete extends \Magento\Backend\App\Action
{
    protected $_collectionFactory, $_modelFactory, $_filter;

    public function __construct(Action\Context $context, NotificationFactory $modelFactory, CollectionFactory $collectionFactory, Filter $filter)
    {
        $this->_modelFactory = $modelFactory;
        $this->_collectionFactory = $collectionFactory;
        $this->_filter = $filter;
        parent::__construct($context);
    }

    public function execute()
    {
        $notificationDeleted = 0;
        try {
            $collection = $this->_filter->getCollection($this->_collectionFactory->create());
            foreach ($collection->getItems() as $item) {
                $resultStaff = $this->_modelFactory->create()->load($item->getData('entity_id'));
                $resultStaff->delete();
                $notificationDeleted++;
            }
        } catch (LocalizedException $e) {
            throwException($e);
        }
        if ($notificationDeleted) {
            $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $notificationDeleted));
        }
        $this->_redirect('*/*/display');
    }
}
