<?php


namespace Magenest\Notification\Model;

use Magenest\Notification\Model\ResourceModel\Notification\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $collection;

    public function __construct
    (
        $name,
        $primaryFieldName,
        $requestFieldName,
        array $meta = [],
        array $data = [],
        CollectionFactory $collectionFactory
    )
    {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        else{
            $this->_loadedData = [];
        }
        $items = $this->collection->getItems();
        foreach ($items as $hotel) {
            $this->_loadedData[$hotel->getEntityId()] = $hotel->getData();
        }
        return $this->_loadedData;
    }

    public function addFilter(\Magento\Framework\Api\Filter $filter)
    {
        return null;
    }
}
