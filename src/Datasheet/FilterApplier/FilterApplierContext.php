<?php

namespace AlexanderA2\PlatformBundle\Datasheet\FilterApplier;

use AlexanderA2\PlatformBundle\Datasheet\DataReader\DataReaderInterface;
use AlexanderA2\PlatformBundle\Datasheet\DatasheetColumnInterface;
use AlexanderA2\PlatformBundle\Datasheet\Filter\FilterInterface;

class FilterApplierContext
{
    public function __construct(
        protected DataReaderInterface       $dataReader,
        protected FilterInterface           $filter,
        protected ?DatasheetColumnInterface $datasheetColumn = null,
    ) {
    }

    public function getDataReader(): DataReaderInterface
    {
        return $this->dataReader;
    }

    public function getFilter(): FilterInterface
    {
        return $this->filter;
    }

    public function getDatasheetColumn(): ?DatasheetColumnInterface
    {
        return $this->datasheetColumn;
    }
}