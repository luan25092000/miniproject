<?php


namespace Magenest\Cybergame\Block;


use Magento\Framework\View\Element\Template;
use Magenest\Cybergame\Model\RoomExtraOptionFactory;
class Add extends Template
{
    protected $_roomExtraOptionFactory;
    public function __construct(Template\Context $context, RoomExtraOptionFactory $roomExtraOptionFactory,array $data = [])
    {
        $this->_roomExtraOptionFactory = $roomExtraOptionFactory;
        parent::__construct($context, $data);
    }
    public function add(){
        $productId = $this->getRequest()->getParam('id');
        $model = $this->_roomExtraOptionFactory->create();
        return $model->load($productId)->getData();
    }
}
