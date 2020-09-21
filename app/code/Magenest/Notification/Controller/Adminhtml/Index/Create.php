<?php


namespace Magenest\Notification\Controller\Adminhtml\Index;


use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
class Create extends Action
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
        $data = $this->getRequest()->getParams();
        if(isset($data['id'])){
            $resultPage->getConfig()->getTitle()->prepend(__('Edit Notification'));
        }
        else{
            $resultPage->getConfig()->getTitle()->prepend(__('Add Notification'));
        }
        return $resultPage;
    }
}
