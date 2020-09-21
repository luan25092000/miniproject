<?php


namespace Magenest\Staff\Ui\Component\Listing\Column;


use Magento\Ui\Component\Listing\Columns\Column;

class Type extends Column
{
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if($item['type']==="1"){
                    $html = "<div>lv1</div>";
                    $item['type'] = $html;
                }
                elseif($item['type']==="2"){
                    $html = "<div>lv2</div>";
                    $item['type'] = $html;
                }
                else{
                    $html = "<div>not staff</div>";
                    $item['type'] = $html;
                }
            }
        }
        return $dataSource;
    }
}
