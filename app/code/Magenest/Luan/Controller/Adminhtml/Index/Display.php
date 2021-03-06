<?php

namespace Magenest\Luan\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Display extends \Magento\Backend\App\Action
{
    protected $_pageFactory;

    public function __construct(Action\Context $context,PageFactory $pageFactory)
    {
        parent::__construct($context);
        $this->_pageFactory = $pageFactory;
    }

    public function execute()
    {
        $resultPage = $this->_pageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Hotel'));
        return $resultPage;
    }
}

