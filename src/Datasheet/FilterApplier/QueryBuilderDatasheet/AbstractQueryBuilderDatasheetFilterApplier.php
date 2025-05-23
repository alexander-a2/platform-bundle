<?php

namespace AlexanderA2\PlatformBundle\Datasheet\FilterApplier\QueryBuilderDatasheet;

use AlexanderA2\PlatformBundle\Datasheet\DataReader\QueryBuilderDataReader;
use AlexanderA2\PlatformBundle\Datasheet\Filter\FilterInterface;
use AlexanderA2\PlatformBundle\Datasheet\FilterApplier\FilterApplierContext;
use AlexanderA2\PlatformBundle\Datasheet\FilterApplier\FilterApplierInterface;

abstract class AbstractQueryBuilderDatasheetFilterApplier implements FilterApplierInterface
{
    public const SUPPORTED_FILTER_CLASS = FilterInterface::class;

    public function supports(FilterApplierContext $context): bool
    {
        return $context->getDataReader() instanceof QueryBuilderDataReader
            && get_class($context->getFilter()) === static::SUPPORTED_FILTER_CLASS;
    }
}