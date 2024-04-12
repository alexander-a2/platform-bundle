<?php

namespace AlexanderA2\PlatformBundle\Datasheet\Filter;

use AlexanderA2\PlatformBundle\Datasheet\DataType\IntegerDataType;

class PaginationFilter extends AbstractFilter
{
    public const SHORT_NAME = 'pgn';

    protected array $attributes = [
        'recordsPerPage' => IntegerDataType::class,
        'currentPage' => IntegerDataType::class,
    ];

    protected array $parameters = [
        'recordsPerPage' => 10,
        'currentPage' => 1,
    ];
}