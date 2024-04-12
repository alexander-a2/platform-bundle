<?php

namespace AlexanderA2\PlatformBundle\Datasheet\Helper;

class ArrayHelper
{
    public static function getPrimaryKey(array $array)
    {
        foreach (EntityHelper::PRIMARY_FIELD_TYPICAL_NAMES as $name) {
            if (array_key_exists($name, $array)) {
                return $name;
            }
        }
    }
}