<?php


namespace Magenest\Luan\Controller\Adminhtml\Index;

use Magenest\Luan\Model\HotelFactory;
use Magenest\Luan\Model\ResourceModel\Hotel\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;

class Delete extends \Magento\Backend\App\Action
{
    protected $_collectionFactory, $_modelFactory, $_filter;

    public function __construct(
        Action\Context $context,
        CollectionFactory $collectionFactory,
        HotelFactory $modelFactory,
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
        $hotelDeleted = 0;
        try {
            $collection = $this->_filter->getCollection($this->_collectionFactory->create());
            foreach ($collection->getItems() as $item) {
                $resultHotel = $this->_modelFactory->create()->load($item->getData('hotel_id'));
                $resultHotel->delete();
                $hotelDeleted++;
            }
        } catch (LocalizedException $e) {
            throwException($e);
        }
        if ($hotelDeleted) {
            $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $hotelDeleted));
        }
        $this->_redirect('*/*/display');
    }
}
