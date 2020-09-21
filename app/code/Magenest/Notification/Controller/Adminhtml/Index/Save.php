<?php


namespace Magenest\Notification\Controller\Adminhtml\Index;


use Magenest\Notification\Model\NotificationFactory;
use Magento\Backend\App\Action;

class Save extends Action
{
    protected $_notificationFactory;
    protected $_messageManager;

    public function __construct(Action\Context $context,
                                NotificationFactory $notificationFactory,
                                \Magento\Framework\Message\ManagerInterface $messageManager
    )
    {
        $this->_notificationFactory = $notificationFactory;
        $this->_messageManager = $messageManager;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $notification = $this->_notificationFactory->create();
        if (isset($data['entity_id'])) {
            $notification->load($data['entity_id']);
            $notification->addData($data);
            $this->_messageManager->addSuccessMessage(__('Successful to update.'));
        } else {
            $notification->addData($data);
            $this->_messageManager->addSuccessMessage(__('Successful to insert.'));
        }
        $notification->save();
        $this->_redirect('*/*/display');
    }
}
