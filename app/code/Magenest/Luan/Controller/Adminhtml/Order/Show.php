<?php


namespace Magenest\Luan\Controller\Adminhtml\Order;


use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
class Show extends Action
{
    protected $_pageFactory;
    public function __construct(Action\Context $context, PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $resultPage = $this->_pageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend('Manage Order');
        return $resultPage;
    }
}
