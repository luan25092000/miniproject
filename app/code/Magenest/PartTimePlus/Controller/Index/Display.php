<?php


namespace Magenest\PartTimePlus\Controller\Index;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
class Display extends Action
{
    protected $_pageFactory;
    public function __construct(Context $context, PageFactory $pageFactory)
    {
        parent::__construct($context);
        $this->_pageFactory = $pageFactory;
    }
    public function execute()
    {
        $resultPage = $this->_pageFactory->create();
        return $resultPage;
    }
}
