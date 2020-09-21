<?php


namespace Magenest\Test\Controller\Customer;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magenest\Test\Model\TestFactory;
class Update extends Action
{
    protected $_testFactory, $_urlInterface;
    public function __construct(Context $context, TestFactory $testFactory,\Magento\Framework\UrlInterface $urlInterface)
    {
        parent::__construct($context);
        $this->_testFactory = $testFactory;
        $this->_urlInterface = $urlInterface;
    }
    public function execute()
    {
        $data  = $this->getRequest()->getParams();
        $model = $this->_testFactory->create();
        $model->load($data['address_id']);
        $model->setData('prefix',$data['prefix']);
        $model->setData('email', $data['email']);
        $model->setData('firstname', $data['firstname']);
        $model->setData('lastname', $data['lastname']);
        $model->setData('fax',$data['fax']);
        $model->setData('telephone', $data['telephone']);
        $model->setData('contact_name', $data['contact_name']);
        $model->setData('country', $data['country']);
        $model->setData('region', $data['region']);
        $model->setData('city', $data['city']);
        $model->save();
        $this->_redirect($this->_urlInterface->getBaseUrl().'test/customer/index/');
    }
}
