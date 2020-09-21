<?php


namespace Magenest\Test\Controller\Adminhtml\Index;


use Magenest\Test\Model\TestFactory;
use Magenest\Test\Model\ResourceModel\Test\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;

class Delete extends \Magento\Backend\App\Action
{
    protected $_collectionFactory, $_modelFactory, $_filter;

    public function __construct(Action\Context $context, TestFactory $modelFactory, CollectionFactory $collectionFactory, Filter $filter)
    {
        $this->_modelFactory = $modelFactory;
        $this->_collectionFactory = $collectionFactory;
        $this->_filter = $filter;
        parent::__construct($context);
    }

    public function execute()
    {
        $addressDeleted = 0;
        try {
            $collection = $this->_filter->getCollection($this->_collectionFactory->create());
            foreach ($collection->getItems() as $item) {
                $resultAddress = $this->_modelFactory->create()->load($item->getData('id'));
                $resultAddress->delete();
                $addressDeleted++;
            }
        } catch (LocalizedException $e) {
            throwException($e);
        }
        if ($addressDeleted) {
            $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $addressDeleted));
        }
        $this->_redirect('*/*/display');
    }
}
