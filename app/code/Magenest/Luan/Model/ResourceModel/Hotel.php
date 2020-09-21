<?php

namespace Magenest\Luan\Model\ResourceModel;

class Hotel extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function _construct()
    {
        $this->_init('hotel_entity','hotel_id');
    }
}
