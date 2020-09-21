<?php


namespace Magenest\Cybergame\Controller\Adminhtml\Index;


use Magenest\Cybergame\Model\RoomExtraOptionFactory;
use Magento\Backend\App\Action;
use Magento\Framework\Message\ManagerInterface;

class Save extends Action
{
    protected $_roomExtraOptionFactory, $_messageManager;

    public function __construct(Action\Context $context, RoomExtraOptionFactory $roomExtraOptionFactory, ManagerInterface $messageManager)
    {
        parent::__construct($context);
        $this->_roomExtraOptionFactory = $roomExtraOptionFactory;
        $this->_messageManager = $messageManager;
    }

    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $model = $this->_roomExtraOptionFactory->create();
        if(isset($data['id'])){
            $model->load($data['id']);
            $model->setData('product_id',$data['product_id']);
            $model->setData('number_pc',$data['number_pc']);
            $model->setData('room_name',$data['room_name']);
            $model->setData('address',$data['address']);
            $model->setData('food_price',$data['food_price']);
            $model->setData('drink_price',$data['drink_price']);
            $model->save();
            $this->_redirect('*/*/display');
            $this->_messageManager->addSuccessMessage(__('Room Details are successful to update.'));
        }
        else{
            $model->setData('product_id',$data['product_id']);
            $model->setData('number_pc',$data['number_pc']);
            $model->setData('room_name',$data['room_name']);
            $model->setData('address',$data['address']);
            $model->setData('food_price',$data['food_price']);
            $model->setData('drink_price',$data['drink_price']);
            $model->save();
            $this->_redirect('*/*/display');
            $this->_messageManager->addSuccessMessage(__('Room Details are successful to insert.'));
        }
    }
}
