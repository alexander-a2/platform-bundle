<?php

namespace AlexanderA2\PlatformBundle\Datasheet\FilterApplier\NestedTreeDatasheet;

use AlexanderA2\PlatformBundle\Datasheet\Filter\FilterInterface;
use AlexanderA2\PlatformBundle\Datasheet\FilterApplier\FilterApplierContext;
use AlexanderA2\PlatformBundle\Datasheet\FilterApplier\FilterApplierInterface;
use AlexanderA2\PlatformBundle\Datasheet\DataReader\NestedTreeDataReader;

abstract class AbstractNestedTreeDatasheetFilterApplier implements FilterApplierInterface
{
    public const SUPPORTED_FILTER_CLASS = FilterInterface::class;

    public function supports(FilterApplierContext $context): bool
    {
        return $context->getDataReader() instanceof NestedTreeDataReader
            && get_class($context->getFilter()) === static::SUPPORTED_FILTER_CLASS;
    }
}