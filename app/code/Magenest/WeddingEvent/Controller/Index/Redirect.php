<?php


namespace Magenest\WeddingEvent\Controller\Index;


use Magenest\WeddingEvent\Model\ResourceModel\Wedding\CollectionFactory;
use Magento\Catalog\Block\Product\ListProductFactory;
use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Redirect extends Action
{
    protected $_collectionFactory, $_productFactory, $_listProductFactory, $_json;
    public function __construct(Context $context,CollectionFactory $collectionFactory,
                                ProductFactory $productFactory,
                                ListProductFactory $listProductFactory
)
    {
        parent::__construct($context);
        $this->_collectionFactory = $collectionFactory;
        $this->_productFactory = $productFactory;
        $this->_listProductFactory = $listProductFactory;
    }
    public function execute()
    {
        $brideEmail = $this->getRequest()->getParam('bride');
        $groomEmail = $this->getRequest()->getParam('groom');
        $wedding = $this->_collectionFactory->create();
        $product = $this->_productFactory->create();
        $listProduct = $this->_listProductFactory->create();
        $wedding->addFieldToFilter('bride_email',$brideEmail);
        $wedding->addFieldToFilter('groom_email',$groomEmail);
        foreach($wedding->getData() as $item){
            $id = $item['id'];
        }
        if(!isset($id)){
            $this->_redirect('http://nhlmg.com/wedding/index/display');
        }
        $product->load($id);
        $addToCartUrl = $listProduct->getAddToCartUrl($product);
        echo $addToCartUrl;
//        $this->_eventManager->dispatch('change_after_add_to_cart',$array);
    }
}
