<?php


namespace Magenest\WeddingEvent\Controller\Adminhtml\Index;

use Magenest\WeddingEvent\Model\WeddingFactory;
use Magenest\WeddingEvent\Model\ResourceModel\Wedding\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;

class Delete extends \Magento\Backend\App\Action
{
    protected $_collectionFactory, $_modelFactory, $_filter;

    public function __construct(
        Action\Context $context,
        CollectionFactory $collectionFactory,
        WeddingFactory $modelFactory,
        Filter $filter
    )
    {
        $this->_modelFactory = $modelFactory;
        $this->_collectionFactory = $collectionFactory;
        $this->_filter = $filter;
        parent::__construct($context);
    }

    public function execute()
    {
        $weddingDeleted = 0;
        try {
            $collection = $this->_filter->getCollection($this->_collectionFactory->create());
            foreach ($collection->getItems() as $item) {
                $resultHotel = $this->_modelFactory->create()->load($item->getData('id'));
                $resultHotel->delete();
                $weddingDeleted++;
            }
        } catch (LocalizedException $e) {
            throwException($e);
        }
        if ($weddingDeleted) {
            $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $weddingDeleted));
        }
        $this->_redirect('*/*/display');
    }
}
