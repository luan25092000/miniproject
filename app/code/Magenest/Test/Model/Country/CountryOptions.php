<?php


namespace Magenest\Test\Model\Country;


class CountryOptions implements \Magento\Framework\Data\OptionSourceInterface
{
    protected $_countryCollectionFactory,$_countryModelFactory;
    public function __construct(
        \Magento\Directory\Model\ResourceModel\Country\CollectionFactory $countryCollectionFactory
    )
    {
        $this->_countryCollectionFactory = $countryCollectionFactory;
    }

    public function toOptionArray()
    {
        $collection = $this->_countryCollectionFactory->create()->loadByStore();
        $options=[];
        foreach($collection as $item){
            $name = $item->getName();
            $options[]=["label"=>$name,"value"=>$name];
        }
        return $options;
    }
}
