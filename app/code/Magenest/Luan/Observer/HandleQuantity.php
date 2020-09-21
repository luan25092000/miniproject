<?php


namespace Magenest\Luan\Observer;


use Magenest\Luan\Model\HotelFactory;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Catalog\Model\ProductFactory;
class HandleQuantity implements ObserverInterface
{
    protected $_hotelFactory, $_registry, $_collectionFactory, $_productFactory;

    public function __construct(HotelFactory $hotelFactory,ProductFactory $productFactory)
    {
        $this->_hotelFactory = $hotelFactory;
        $this->_productFactory = $productFactory;
    }

    public function execute(Observer $observer)
    {
        $hotelModel = $this->_hotelFactory->create();
        $productModel = $this->_productFactory->create();
        $qtyOrdered = $observer->getOrder()->getData('total_qty_ordered');//Get quantity ordered
        $items = $observer->getOrder()->getItems();
        foreach ($items as $item) {
            $idProduct = $item->getProductId();
            $productModel->load($idProduct);
            $roomType = $productModel->getData('room_type');
            foreach ($item->getData('product_options') as $data) {
                $hotelId = $data['hotel_select']; //Get hotel id
                //Handle type room to set quantity available room
                if($roomType === "single"){
                    $result = $hotelModel->load($hotelId)->getData('available_single') - $qtyOrdered;
                    $hotelModel->setData('available_single',$result);
                }
                elseif($roomType === "double"){
                    $result = $hotelModel->load($hotelId)->getData('available_double') - $qtyOrdered;
                    $hotelModel->setData('available_double',$result);
                }
                elseif($roomType === "triple"){
                    $result = $hotelModel->load($hotelId)->getData('available_triple') - $qtyOrdered;
                    $hotelModel->setData('available_triple',$result);
                }
                $hotelModel->save();
            }
        }
    }
}
