<?php

namespace AlexanderA2\PlatformBundle\Event;

use AlexanderA2\PhpDatasheet\DatasheetInterface;

class EntityDatasheetBuildEvent
{
    public function __construct(
        protected string $entityClassName,
        protected DatasheetInterface $datasheet){
    }

    public function getEntityClassName(): string
    {
        return $this->entityClassName;
    }

    public function getDatasheet(): DatasheetInterface
    {
        return $this->datasheet;
    }
}