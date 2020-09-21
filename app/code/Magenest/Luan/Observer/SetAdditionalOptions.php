<?php

namespace Magenest\Luan\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Serialize\Serializer\Json;

class SetAdditionalOptions implements ObserverInterface
{
    protected $json;
    /**
     * @var RequestInterface
     */
    protected $_request;

    /**
     * @param RequestInterface $request
     * @param Json $json
     */
    public function __construct(
        RequestInterface $request,
        Json $json
    ) {
        $this->_request = $request;
        $this->json = $json ?: \Magento\Framework\App\ObjectManager::getInstance()
            ->get(\Magento\Framework\Serialize\Serializer\Json::class);
    }
    public function execute(Observer $observer)
    {
        // Check and set information according to your need
        if ($this->_request->getFullActionName() == 'checkout_cart_add') { //checking when product is adding to cart
            $additionalOptions = [];
            $product = $observer->getEvent()->getProduct();
            $value = $this->_request->getParam('hotel_select');
            $additionalOptions[] = [
                'label' => "Hotel",
                'value' => $value
            ];
            $product->addCustomOption('additional_options', $this->json->serialize($additionalOptions));
        }
    }
}
