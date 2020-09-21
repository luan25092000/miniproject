<?php

namespace Magenest\WeddingEvent\Model\ResourceModel\Wedding;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Magenest\WeddingEvent\Model\Staff', 'Magenest\WeddingEvent\Model\ResourceModel\Staff');
    }
}
