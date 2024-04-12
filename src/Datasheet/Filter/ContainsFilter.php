<?php

namespace AlexanderA2\PlatformBundle\Datasheet\Filter;

use AlexanderA2\PlatformBundle\Datasheet\DataType\StringDataType;

class ContainsFilter extends AbstractFilter
{
    public const SHORT_NAME = 'has';

    protected array $attributes = [
        'value' => StringDataType::class,
    ];
}