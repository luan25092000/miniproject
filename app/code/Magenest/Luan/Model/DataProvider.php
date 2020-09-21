<?php


namespace Magenest\Luan\Model;

use Magenest\Luan\Model\ResourceModel\Hotel\CollectionFactory;

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
            $this->_loadedData[$hotel->getHotelId()] = $hotel->getData();
        }
        return $this->_loadedData;
    }

    public function addFilter(\Magento\Framework\Api\Filter $filter)
    {
        return null;
    }
}
