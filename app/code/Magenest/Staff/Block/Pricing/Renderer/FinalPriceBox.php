<?php


namespace Magenest\Staff\Block\Pricing\Renderer;


use Magento\Catalog\Model\Product\Pricing\Renderer\SalableResolverInterface;
use Magento\Catalog\Pricing\Price\MinimalPriceCalculatorInterface;
use Magento\Framework\Pricing\Price\PriceInterface;
use Magento\Framework\Pricing\Render\RendererPool;
use Magento\Framework\Pricing\SaleableInterface;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\App\Http\Context as AuthContext;
use Magenest\Staff\Model\ResourceModel\Staff\CollectionFactory;
class FinalPriceBox extends \Magento\Catalog\Pricing\Render\FinalPriceBox
{
    protected $_authContext;
    protected $_collectionFactory;
    public function __construct(Context $context,
                                SaleableInterface $saleableItem,
                                PriceInterface $price,
                                RendererPool $rendererPool,
                                AuthContext $authContext,
                                CollectionFactory $collectionFactory,
                                array $data = [],
                                SalableResolverInterface $salableResolver = null,
                                MinimalPriceCalculatorInterface $minimalPriceCalculator = null
                                )
    {
        $this->_authContext = $authContext;
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context, $saleableItem, $price, $rendererPool, $data, $salableResolver, $minimalPriceCalculator);
    }

    protected function wrapResult($html)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->create('Magento\Customer\Model\Session');
        $isLoggedIn = $this->_authContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
        $collection = $this->_collectionFactory->create();
        if($isLoggedIn){
            $customerId = $customerSession->getCustomer()->getId();
        }
        else{
            return '<span class="price-box ' . $this->getData('css_classes') . '" ' .
                'data-role="priceBox" ' .
                'data-product-id="' . $this->getSaleableItem()->getId() . '" ' .
                'data-price-box="product-id-' . $this->getSaleableItem()->getId() . '"' .
                '>' . $html . '</span>';
        }
        $collection->addFieldToFilter('customer_id',$customerId);
        foreach($collection->getData() as $item){
            $level = $item['type'];
            if($level==1){
                return '<span class="price-box ' . $this->getData('css_classes') . '" ' .
                    'data-role="priceBox" ' .
                    'data-product-id="' . $this->getSaleableItem()->getId() . '" ' .
                    'data-price-box="product-id-' . $this->getSaleableItem()->getId() . '"' .
                    '>' . $html . '(lv1)</span>';
            }
            elseif ($level==2){
                return '<span class="price-box ' . $this->getData('css_classes') . '" ' .
                    'data-role="priceBox" ' .
                    'data-product-id="' . $this->getSaleableItem()->getId() . '" ' .
                    'data-price-box="product-id-' . $this->getSaleableItem()->getId() . '"' .
                    '>' . $html . '(lv2)</span>';
            }
        }
    }
}
