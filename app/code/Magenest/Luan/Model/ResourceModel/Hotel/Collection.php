<?php

namespace Magenest\Luan\Model\ResourceModel\Hotel;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Magenest\Luan\Model\Test', 'Magenest\Luan\Model\ResourceModel\Test');
    }
}
