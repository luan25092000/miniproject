<?php

namespace Magenest\Test\Model\ResourceModel\Test;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Magenest\Test\Model\Test', 'Magenest\Test\Model\ResourceModel\Test');
    }
}
