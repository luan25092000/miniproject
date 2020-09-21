<?php


namespace Magenest\Luan\Block;


use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\View\Element\Template;
use Magenest\Luan\Model\ResourceModel\Hotel\CollectionFactory;
class Handle extends Template
{
    protected $_productFactory, $_registry, $_collectionFactory;
    public function __construct(Template\Context $context,
                                ProductFactory $productFactory,
                                \Magento\Framework\Registry $registry,
                                CollectionFactory $collectionFactory,
                                array $data = [])
    {
        parent::__construct($context, $data);
        $this->_productFactory = $productFactory;
        $this->_registry = $registry;
        $this->_collectionFactory = $collectionFactory;
    }
    public function getHotel()
    {
        $collection = $this->_collectionFactory->create();
        $idProduct = $this->_registry->registry('current_product')->getId();
        $model = $this->_productFactory->create();
        $model->load($idProduct);
        $roomType =  $model->getData('room_type');
        if($roomType === "single"){
            $collection->addFieldToFilter('available_single', ['gt' => 0]);
        }
        elseif($roomType === "double"){
            $collection->addFieldToFilter('available_double',['gt' => 0]);
        }
        elseif($roomType === "triple"){
            $collection->addFieldToFilter('available_triple',['gt' => 0]);
        }
        return $collection;
    }
}
