<?php


namespace Magenest\SA\Model\Config\Source;


use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
class Options extends AbstractSource
{
    public function getAllOptions()
    {
        $options = [
            ['label' => 'fixed', 'value' => 'fixed'],
            ['label' => 'percent', 'value' => 'percent'],
        ];
        return $options;
    }
}
