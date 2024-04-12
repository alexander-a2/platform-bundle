<?php

namespace AlexanderA2\PlatformBundle\Datasheet\Filter;

use AlexanderA2\PlatformBundle\Datasheet\DataType\StringDataType;

class EqualsFilter extends AbstractFilter
{
    public const SHORT_NAME = 'eq';

    protected array $attributes = [
        'value' => StringDataType::class,
    ];
}