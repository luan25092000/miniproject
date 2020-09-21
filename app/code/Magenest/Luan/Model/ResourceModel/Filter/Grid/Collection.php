<?php


namespace Magenest\Luan\Model\ResourceModel\Filter\Grid;


use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;
use Psr\Log\LoggerInterface as Logger;

class Collection extends SearchResult
{
    public function __construct(EntityFactory $entityFactory, Logger $logger, FetchStrategy $fetchStrategy, EventManager $eventManager, $mainTable, $resourceModel = null, $identifierName = null, $connectionName = null)
    {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $mainTable, $resourceModel, $identifierName, $connectionName);
    }
    protected function _initSelect()
    {
//        $productTable = $this->getTable('catalog_product_entity');
//        $productTableVarchar = $this->getTable('catalog_product_entity_varchar');
//        $this->getSelect()
//            ->join(['product1'=>$productTableVarchar],"main_table.entity_id = product1.entity_id",["product_name" => "product1.value"])
//            ->join(['product2'=>$productTableVarchar],"main_table.entity_id = product2.entity_id");
//        $this->getSelect()
//            ->join(['product3'=>$productTable],"main_table.entity_id = product3.entity_id",["created_at" => "main_table.created_at"]);
//        $this->getSelect()
//            ->join(['product4'=>$productTable],"main_table.entity_id = product4.entity_id",["order_status" => "main_table.status"]);
        return parent::_initSelect();
    }
}
