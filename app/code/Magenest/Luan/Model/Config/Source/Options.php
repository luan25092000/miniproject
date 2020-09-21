<?php


namespace Magenest\Luan\Model\Config\Source;


use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
class Options extends AbstractSource
{
    public function getAllOptions()
    {
        $options = [
            ['label' => 'single', 'value' => 'single'],
            ['label' => 'double', 'value' => 'double'],
            ['label' => 'triple', 'value' => 'triple']
        ];
        return $options;
    }
}
