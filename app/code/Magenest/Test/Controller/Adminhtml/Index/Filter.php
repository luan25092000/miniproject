<?php


namespace Magenest\Test\Controller\Adminhtml\Index;


use Magento\Backend\App\Action;

class Filter extends Action
{
    public function __construct(Action\Context $context)
    {
        parent::__construct($context);
    }
    public function execute()
    {
        $data = $this->getRequest()->getParam('selected');
    }
}
