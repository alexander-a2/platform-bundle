<?php
declare(strict_types=1);

namespace AlexanderA2\PlatformBundle\Datasheet\DataType;

class BooleanDataType implements DataTypeInterface
{
    public static function toString($value): string
    {
        return (string)$value;
    }

    public static function fromString($value): bool
    {
        return (bool)$value;
    }

    public static function getFilters(): array
    {
        return [];
    }

    public static function is(mixed $value): bool
    {
        return is_bool($value);
    }
}