<?php


namespace Magenest\Test\Controller\Adminhtml\Index;


use Magenest\Test\Model\TestFactory;
use Magento\Backend\App\Action;
use Magento\Framework\Message\ManagerInterface;

class Save extends Action
{
    protected $_testFactory, $_messageManager;

    public function __construct(Action\Context $context,
                                TestFactory $testFactory,
                                ManagerInterface $messageManager)
    {
        parent::__construct($context);
        $this->_testFactory = $testFactory;
        $this->_messageManager = $messageManager;
    }

    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $model = $this->_testFactory->create();
        if (isset($data['id'])) {
            $model->load($data['id']);
            $model->addData($data);
            $this->_eventManager->dispatch('after_save_change_prefix_name',$data);
            $this->_redirect('*/*/display');
            $this->_messageManager->addSuccessMessage(__('Addresses are successful to update.'));
        } else {
            $model->addData($data);
            $this->_eventManager->dispatch('after_save_change_prefix_name',$data);
            $model->save();
            $this->_redirect('*/*/display');
            $this->_messageManager->addSuccessMessage(__('Addresses are successful to insert.'));
        }
    }
}
