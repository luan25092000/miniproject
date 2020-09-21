<?php


namespace Magenest\Luan\Controller\Adminhtml\Index;


use Magento\Backend\App\Action;
use Magenest\Luan\Model\HotelFactory;
use Magento\Framework\Message\ManagerInterface;
class Save extends Action
{
    protected $_hotelFactory, $_messageManager;
    public function __construct(Action\Context $context, HotelFactory $hotelFactory, ManagerInterface $messageManager)
    {
        parent::__construct($context);
        $this->_hotelFactory = $hotelFactory;
        $this->_messageManager = $messageManager;
    }
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $model = $this->_hotelFactory->create();
        if(isset($data['hotel_id'])){
            $model->load($data['hotel_id']);
            $model->setData('hotel_name',$data['hotel_name']);
            $model->setData('location_street',$data['location_street']);
            $model->setData('location_city',$data['location_city']);
            $model->setData('location_state',$data['location_state']);
            $model->setData('location_country',$data['location_country']);
            $model->setData('contact_phone',$data['contact_phone']);
            $model->setData('total_available_room',$data['total_available_room']);
            $model->setData('available_single',$data['available_single']);
            $model->setData('available_double',$data['available_double']);
            $model->setData('available_triple',$data['available_triple']);
            $model->save();
            $this->_redirect('*/*/display');
            $this->_messageManager->addSuccessMessage(__('Hotel Details are successful to update.'));
        }
        else{
            $model->setData('hotel_name',$data['hotel_name']);
            $model->setData('location_street',$data['location_street']);
            $model->setData('location_city',$data['location_city']);
            $model->setData('location_state',$data['location_state']);
            $model->setData('location_country',$data['location_country']);
            $model->setData('contact_phone',$data['contact_phone']);
            $model->setData('total_available_room',$data['total_available_room']);
            $model->setData('available_single',$data['available_single']);
            $model->setData('available_double',$data['available_double']);
            $model->setData('available_triple',$data['available_triple']);
            $model->save();
            $this->_redirect('*/*/display');
            $this->_messageManager->addSuccessMessage(__('Hotel Details are successful to create.'));
        }
    }
}
