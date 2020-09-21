<?php


namespace Magenest\Test\Ui\Component\Listing\Column;


class Actions extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                // here we can also use the data from $item to configure some parameters of an action URL
                $item[$this->getData('name')] = [
                    'edit' => [
                        'href' => '/admin/test/index/create/id/'.$item['id'],
                        'label' => __('Edit')
                    ]
                ];
            }
        }

        return $dataSource;
    }
}

