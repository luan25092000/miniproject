<?php


namespace Magenest\Staff\Model\Config\Source;


use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
class Options extends AbstractSource
{
    public function getAllOptions()
    {
        $options = [
            ['label' => 'lv1', 'value' => '1'],
            ['label' => 'lv2', 'value' => '2'],
            ['label' => 'not staff','value' => '0']
        ];
        return $options;
    }
}
