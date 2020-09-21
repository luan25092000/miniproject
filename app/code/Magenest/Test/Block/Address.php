<?php


namespace Magenest\Test\Block;


use Magento\Framework\View\Element\Template;
use Magenest\Test\Model\ResourceModel\Test\CollectionFactory;
class Address extends Template
{
    protected $_collectionFactory, $_urlInterface;
    public function __construct(Template\Context $context,
                                CollectionFactory $collectionFactory,
                                \Magento\Framework\UrlInterface $urlInterface,
                                array $data = [])
    {
        parent::__construct($context, $data);
        $this->_collectionFactory = $collectionFactory;
        $this->_urlInterface = $urlInterface;
    }
    public function getAddress(){
        return $this->_collectionFactory->create()->getData();
    }
    public function getBaseUrl()
    {
        return $this->_urlInterface->getBaseUrl();
    }
}
