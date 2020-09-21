<?php


namespace Magenest\Cybergame\Controller\Adminhtml\Index;


use Magenest\Cybergame\Model\RoomExtraOptionFactory;
use Magenest\Cybergame\Model\ResourceModel\RoomExtraOption\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;

class Delete extends \Magento\Backend\App\Action
{
    protected $_collectionFactory, $_modelFactory, $_filter;

    public function __construct(Action\Context $context, RoomExtraOptionFactory $modelFactory, CollectionFactory $collectionFactory, Filter $filter)
    {
        $this->_modelFactory = $modelFactory;
        $this->_collectionFactory = $collectionFactory;
        $this->_filter = $filter;
        parent::__construct($context);
    }

    public function execute()
    {
        $roomDeleted = 0;
        try {
            $collection = $this->_filter->getCollection($this->_collectionFactory->create());
            foreach ($collection->getItems() as $item) {
                $resultRoom = $this->_modelFactory->create()->load($item->getData('id'));
                $resultRoom->delete();
                $roomDeleted++;
            }
        } catch (LocalizedException $e) {
            throwException($e);
        }
        if ($roomDeleted) {
            $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $roomDeleted));
        }
        $this->_redirect('*/*/display');
    }
}
