<?php
declare(strict_types=1);

namespace AlexanderA2\PlatformBundle\Datasheet\DataType;

interface DataTypeInterface
{
    public static function toString($value): string;

    public static function fromString($value): mixed;

    public static function getFilters(): array;

    public static function is(mixed $value): bool;
}