<?php

namespace AlexanderA2\PlatformBundle\Datasheet\FilterApplier\NestedTreeDatasheet\ColumnFilter;

use AlexanderA2\PlatformBundle\Datasheet\Filter\EqualsFilter;
use AlexanderA2\PlatformBundle\Datasheet\FilterApplier\FilterApplierContext;
use AlexanderA2\PlatformBundle\Datasheet\Filter\Applier\NestedTreeDatasheet\AbstractNestedTreeDatasheetFilterApplier;

class EqualsFilterApplier extends AbstractNestedTreeDatasheetFilterApplier
{
    public const SUPPORTED_FILTER_CLASS = EqualsFilter::class;

    public function apply(FilterApplierContext $context)
    {
    }
}