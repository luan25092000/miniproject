<?php


namespace Magenest\PartTimePlus\Block;


use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\ProductFactory;
class Handle extends Template
{
    protected $_productFactory;
    protected $_registry;
    protected $step;
    public function __construct(Template\Context $context,
                                ProductFactory $productFactory,
                                \Magento\Framework\Registry $registry,
                                array $data = [])
    {
        $this->_productFactory = $productFactory;
        $this->_registry = $registry;
        $this->step = 0;
        parent::__construct($context, $data);
    }
    public function showQuestion(){
        if($this->step===0){
            $product = $this->_productFactory->create();
            $productId = $this->_registry->registry('current_product')->getId();
            $product->load($productId);
            $result = strrev(substr($product->getData('question'),0,5));
            $product->setData('question', $result);
            $product->save();
            $this->step = 1;
            return $result;
        }
    }
}
