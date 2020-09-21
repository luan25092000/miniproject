<?php


namespace Magenest\Cybergame\Block;


use Magento\Framework\View\Element\Template;
use Magenest\Cybergame\Model\GameAccountListFactory;
class Account extends Template
{
    protected $_gameAccountListFactory;
    public function __construct(Template\Context $context,
                                GameAccountListFactory $gameAccountListFactory,
                                array $data = [])
    {
        parent::__construct($context, $data);
        $this->_gameAccountListFactory = $gameAccountListFactory;
    }
    public function createAccount($account){
        $model = $this->_gameAccountListFactory->create();
        $model->setData('account_name',$account);
        $model->setData('password',1);
        $model->save();
    }
}
