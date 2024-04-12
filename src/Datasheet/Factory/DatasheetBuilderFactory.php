<?php

namespace AlexanderA2\PlatformBundle\Datasheet\Factory;

use AlexanderA2\PlatformBundle\Datasheet\Builder\Column\ArrayDatasheetColumnBuilder;
use AlexanderA2\PlatformBundle\Datasheet\Builder\Column\QueryBuilderDatasheetColumnBuilder;
use AlexanderA2\PlatformBundle\Datasheet\Builder\DatasheetBuilder;
use AlexanderA2\PlatformBundle\Datasheet\DataReader\ArrayDataReader;
use AlexanderA2\PlatformBundle\Datasheet\DataReader\QueryBuilderDataReader;
use AlexanderA2\PlatformBundle\Datasheet\FilterApplier\ArrayDatasheet\ColumnFilter\ContainsFilterApplier as ArrayDatasheetColumnContainsFilterApplier;
use AlexanderA2\PlatformBundle\Datasheet\FilterApplier\ArrayDatasheet\ColumnFilter\EqualsFilterApplier as ArrayDatasheetColumnEqualsFilterApplier;
use AlexanderA2\PlatformBundle\Datasheet\FilterApplier\ArrayDatasheet\DatasheetFilter\PaginationFilterApplier as ArrayDatasheetPaginationFilterApplier;
use AlexanderA2\PlatformBundle\Datasheet\FilterApplier\ArrayDatasheet\DatasheetFilter\SortFilterApplier as ArrayDatasheetSortFilterApplier;
use AlexanderA2\PlatformBundle\Datasheet\FilterApplier\QueryBuilderDatasheet\ColumnFilter\ContainsFilterApplier as QueryBuilderDatasheetColumnContainsFilterApplier;
use AlexanderA2\PlatformBundle\Datasheet\FilterApplier\QueryBuilderDatasheet\ColumnFilter\EqualsFilterApplier as QueryBuilderDatasheetColumnEqualsFilterApplier;
use AlexanderA2\PlatformBundle\Datasheet\FilterApplier\QueryBuilderDatasheet\DatasheetFilter\PaginationFilterApplier as QueryBuilderDatasheetPaginationFilterApplier;
use AlexanderA2\PlatformBundle\Datasheet\FilterApplier\QueryBuilderDatasheet\DatasheetFilter\SortFilterApplier as QueryBuilderDatasheetSortFilterApplier;
use AlexanderA2\PlatformBundle\Datasheet\Resolver\ColumnBuilderResolver;
use AlexanderA2\PlatformBundle\Datasheet\Resolver\DataReaderResolver;
use AlexanderA2\PlatformBundle\Datasheet\Resolver\FilterApplierResolver;

class DatasheetBuilderFactory
{
//    public function get()
//    {
//        return new DatasheetBuilder(
//            $this->getDataReaderResolver(),
//            $this->getColumnBuilderResolver(),
//            $this->getFilterApplierResolver(),
//        );
//    }
//
//    protected function getDataReaderResolver(): DataReaderResolver
//    {
//        return new DataReaderResolver([
//            new QueryBuilderDataReader(),
//            new ArrayDataReader(),
//        ]);
//    }
//
//    protected function getColumnBuilderResolver(): ColumnBuilderResolver
//    {
//        return new ColumnBuilderResolver([
//            new ArrayDatasheetColumnBuilder(),
//            new QueryBuilderDatasheetColumnBuilder(),
//        ]);
//    }
//
//    protected function getFilterApplierResolver(): FilterApplierResolver
//    {
//        return new FilterApplierResolver([
//            new ArrayDatasheetPaginationFilterApplier(),
//            new ArrayDatasheetSortFilterApplier(),
//            new ArrayDatasheetColumnEqualsFilterApplier(),
//            new ArrayDatasheetColumnContainsFilterApplier(),
//            new QueryBuilderDatasheetPaginationFilterApplier(),
//            new QueryBuilderDatasheetSortFilterApplier(),
//            new QueryBuilderDatasheetColumnEqualsFilterApplier(),
//            new QueryBuilderDatasheetColumnContainsFilterApplier(),
//        ]);
//    }
}