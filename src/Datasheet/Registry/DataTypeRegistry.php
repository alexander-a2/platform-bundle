<?php

namespace AlexanderA2\PlatformBundle\Datasheet\Registry;

use AlexanderA2\PlatformBundle\Datasheet\DataType\BooleanDataType;
use AlexanderA2\PlatformBundle\Datasheet\DataType\DateDataType;
use AlexanderA2\PlatformBundle\Datasheet\DataType\DateTimeDataType;
use AlexanderA2\PlatformBundle\Datasheet\DataType\FloatDataType;
use AlexanderA2\PlatformBundle\Datasheet\DataType\IntegerDataType;
use AlexanderA2\PlatformBundle\Datasheet\DataType\ObjectDataType;
use AlexanderA2\PlatformBundle\Datasheet\DataType\StringDataType;

class DataTypeRegistry
{
    public function get(): array
    {
        return [
            BooleanDataType::class,
            DateDataType::class,
            DateTimeDataType::class,
            FloatDataType::class,
            IntegerDataType::class,
            ObjectDataType::class,
            StringDataType::class,
        ];
    }
}