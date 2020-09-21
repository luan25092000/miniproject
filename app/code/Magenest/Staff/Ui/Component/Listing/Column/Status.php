<?php


namespace Magenest\Staff\Ui\Component\Listing\Column;


use Magento\Ui\Component\Listing\Columns\Column;

class Status extends Column
{
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if($item['status']==="1"){
                    $html = "<div>Pending</div>";
                    $item['status'] = $html;
                }
                elseif($item['status']==="2"){
                    $html = "<div>Approved</div>";
                    $item['status'] = $html;
                }
            }
        }
        return $dataSource;
    }
}
