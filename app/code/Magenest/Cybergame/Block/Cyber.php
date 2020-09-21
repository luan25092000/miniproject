<?php


namespace Magenest\Cybergame\Block;


use Magento\Framework\View\Element\Template;
use Magenest\Cybergame\Model\RoomExtraOptionFactory;
class Cyber extends Template
{
    protected $_roomExtraOptionFactory,$_productFactory,$_registry;
    public function __construct(Template\Context $context,
                                RoomExtraOptionFactory $roomExtraOptionFactory,
                                \Magento\Framework\Registry $registry,
                                array $data = [])
    {
        parent::__construct($context, $data);
        $this->_roomExtraOptionFactory = $roomExtraOptionFactory;
        $this->_registry = $registry;
    }
    public function showInfo(){
        $model = $this->_roomExtraOptionFactory->create();
        $idProduct = $this->_registry->registry('current_product')->getId();
        return $model->load($idProduct)->getData();
    }
}
