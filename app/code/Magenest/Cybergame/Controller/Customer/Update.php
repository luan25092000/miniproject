<?php


namespace Magenest\Cybergame\Controller\Customer;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magenest\Cybergame\Model\RoomExtraOptionFactory;
class Update extends Action
{
    protected $_roomExtraOptionFactory;
    public function __construct(Context $context, RoomExtraOptionFactory $roomExtraOptionFactory)
    {
        parent::__construct($context);
        $this->_roomExtraOptionFactory = $roomExtraOptionFactory;
    }
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $model = $this->_roomExtraOptionFactory->create();
        $model->load($data['product_id']);
        $model->setData('number_pc',$data['number_pc']);
        $model->setData('address', $data['address']);
        $model->setData('food_price', $data['food_price']);
        $model->setData('drink_price', $data['drink_price']);
        $model->save();
        $this->_redirect('http://nhlmg.com/cybergame/customer/index/');
    }
}
