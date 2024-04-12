<?php

namespace AlexanderA2\PlatformBundle\Datasheet\DataReader;

use AlexanderA2\PlatformBundle\Datasheet\DatasheetInterface;
use Doctrine\Common\Collections\ArrayCollection;

interface DataReaderInterface
{
    public function setSource(mixed $source);

    public function getSource(): mixed;

    public function readData(): ArrayCollection;

    public function getTotalRecords(): int;

    public static function supports(DatasheetInterface $datasheet): bool;
}