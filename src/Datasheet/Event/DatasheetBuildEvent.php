<?php

namespace AlexanderA2\PlatformBundle\Datasheet\Event;

use AlexanderA2\PlatformBundle\Datasheet\DatasheetInterface;

class DatasheetBuildEvent
{
    public function __construct(
        protected DatasheetInterface $datasheet
    ) {
    }

    public function getDatasheet(): DatasheetInterface
    {
        return $this->datasheet;
    }
}