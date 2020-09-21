<?php


namespace Magenest\PartTimePlus\Ui\Component\Listing\Column;


use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
class OddEven extends Column
{
    public function __construct(ContextInterface $context, UiComponentFactory $uiComponentFactory, array $components = [], array $data = [])
    {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if($item['custom_prefix']%2===1){
                    $html = "<div class='grid-severity-minor'>Odd</div>";
                }
                else{
                    $html = "<div class='grid-severity-critical'>Even</div>";
                }
                $item['custom_prefix'] = $html;
            }
        }
        return $dataSource;
    }
}
