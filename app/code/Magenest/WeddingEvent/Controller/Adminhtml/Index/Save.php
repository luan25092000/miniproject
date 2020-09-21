<?php


namespace Magenest\WeddingEvent\Controller\Adminhtml\Index;


use Magento\Backend\App\Action;
use Magenest\WeddingEvent\Model\WeddingFactory;
use Magento\Framework\Message\ManagerInterface;
class Save extends Action
{
    protected $_weddingFactory, $_messageManager;
    public function __construct(Action\Context $context, WeddingFactory $weddingFactory, ManagerInterface $messageManager)
    {
        parent::__construct($context);
        $this->_weddingFactory = $weddingFactory;
        $this->_messageManager = $messageManager;
    }
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $model = $this->_weddingFactory->create();
        if(isset($data['id'])){
            $model->load($data['id']);
            $model->addData($data);
            $model->save();
            $this->_redirect('*/*/display');
            $this->_messageManager->addSuccessMessage(__('Wedding Events Details are successful to update.'));
        }
        else{
            $model->addData($data);
            $model->save();
            $this->_eventManager->dispatch('after_create_wedding_event',$model->getData());
            $this->_redirect('*/*/display');
            $this->_messageManager->addSuccessMessage(__('Wedding Events Details are successful to insert.'));
        }
    }
}
