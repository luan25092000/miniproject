<?php

namespace Magenest\Notification\Model\ResourceModel\Notification;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Magenest\Notification\Model\Notification', 'Magenest\Notification\Model\ResourceModel\Notification');
    }
}
