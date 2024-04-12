<?php

namespace AlexanderA2\PlatformBundle\Datasheet\Filter;

use AlexanderA2\PlatformBundle\Datasheet\DataType\IntegerDataType;

class SortFilter extends AbstractFilter
{
    public const SHORT_NAME = 'sort';

    protected array $attributes = [
        'by' => IntegerDataType::class,
        'direction' => IntegerDataType::class,
    ];
}