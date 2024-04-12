<?php

namespace AlexanderA2\PlatformBundle\Datasheet\Builder\Column;

use AlexanderA2\PlatformBundle\Datasheet\DatasheetInterface;
use Doctrine\Common\Collections\ArrayCollection;

interface ColumnBuilderInterface
{
    public static function supports(DatasheetInterface $datasheet): bool;

    public function addColumnsToDatasheet(DatasheetInterface $datasheet): DatasheetInterface;
}