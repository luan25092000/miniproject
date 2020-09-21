<?php


namespace Magenest\Test\Controller\Customer;


use Magento\Cms\Block\Page;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
class Edit extends Action
{
    protected $_pageFactory;
    public function __construct(Context $context, PageFactory $pageFactory)
    {
        parent::__construct($context);
        $this->_pageFactory = $pageFactory;
    }
    public function execute()
    {
        return $this->_pageFactory->create();
    }
}
