<?php


namespace Magenest\PartTimePlus\Plugin;


class QuotePlugin
{
    protected $url;
    protected $_checkoutSession;

    public function __construct(\Magento\Framework\UrlInterface $url,
                                \Magento\Checkout\Model\Session $checkoutSession)
    {
        $this->_checkoutSession = $checkoutSession;
        $this->url = $url;
    }

    public function afterAddProduct(\Magento\Quote\Model\Quote $subject,
                                    $result)
    {
        if ($result->getQty() <= 1) {
            throw new \Exception();
        }
//             if (!$this->_checkoutSession->getNoCartRedirect(true)) {
//                if (!$this->cart->getQuote()->getHasError()) {
//                    if ($this->shouldRedirectToCart()) {
//                        $message = __(
//                            'You added %1 to your shopping cart.',
//                            $product->getName()
//                        );
//                        $this->messageManager->addSuccessMessage($message);
//                    } else {
//                        $this->messageManager->addComplexSuccessMessage(
//                            'addCartSuccessMessage',
//                            [
//                                'product_name' => $product->getName(),
//                                'cart_url' => $this->getCartUrl(),
//                            ]
//                        );
//                    }
//                }
//                 return $this->url->getUrl('checkout/cart', ['_secure' => true]);


    }
}
