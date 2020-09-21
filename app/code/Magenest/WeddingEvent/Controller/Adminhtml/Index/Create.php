<?php


namespace Magenest\WeddingEvent\Controller\Adminhtml\Index;


use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
class Create extends Action
{
    protected $_pageFactory;
    public function __construct(Action\Context $context, PageFactory $pageFactory)
    {
        parent::__construct($context);
        $this->_pageFactory = $pageFactory;
    }
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $resultPage=$this->_pageFactory->create();
        if(isset($data['id'])){
            $resultPage->getConfig()->getTitle()->prepend(__('Edit Wedding Events Form'));
        }
        else{
            $resultPage->getConfig()->getTitle()->prepend(__('Add Wedding Events Form'));
        }
        return $resultPage;
    }
}
