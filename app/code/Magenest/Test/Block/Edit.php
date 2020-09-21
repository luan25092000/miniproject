<?php


namespace Magenest\Test\Block;


use Magento\Framework\View\Element\Template;
use Magenest\Test\Model\TestFactory;
class Edit extends Template
{
    protected $_testFactory,$_urlInterface;
    public function __construct(Template\Context $context,
                                TestFactory $testFactory,
                                \Magento\Framework\UrlInterface $urlInterface
                                ,array $data = [])
    {
        parent::__construct($context, $data);
        $this->_testFactory = $testFactory;
        $this->_urlInterface = $urlInterface;
    }
    public function edit(){
        $id = $this->getRequest()->getParam('id');
        return $this->_testFactory->create()->load($id)->getData();
    }
    public function getBaseUrl()
    {
        return $this->_urlInterface->getBaseUrl();
    }
}
