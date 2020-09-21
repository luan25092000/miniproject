<?php


namespace Magenest\WeddingEvent\Observer;

use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class ChangeWeddingId implements ObserverInterface
{
    protected $_productFactory, $productRepository;

    public function __construct(ProductFactory $productFactory

    )
    {
        $this->_productFactory = $productFactory;
    }

    public function execute(Observer $observer)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $url = preg_replace('#[^0-9a-z]+#i', '-', $observer->getData('title').$observer->getData('id'));
        $url = strtolower($url);
        $categoryLinkRepository = $objectManager->get('\Magento\Catalog\Api\CategoryLinkManagementInterface');
        $categoryIds = array('2','3');
        $product = $this->_productFactory->create();
        $product->setData('wedding_id ', $observer->getData('id'));
        $product->setData('attribute_set_id', 4);
        $product->setData('name', $observer->getData('title'));
        $product->setData('type_id', 'virtual');
        $product->setData('sku', "wedding" . $observer->getData('id'));
        $product->setData('price', $observer->getData('commission'));
        $product->setVisibility(\Magento\Catalog\Model\Product\Visibility::VISIBILITY_BOTH);
        $product->setStatus(\Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED);
        $product->setStockData(['qty' => 1, 'is_in_stock' => 1]);
        $product->setUrlKey($url);
        $product->setWebsiteIds([1]);
        $product->save();
        $categoryLinkRepository->assignProductToCategories("wedding" . $observer->getData('id'), $categoryIds);
    }
}
