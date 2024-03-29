<?php

namespace AlexanderA2\PlatformBundle\Builder;

use AlexanderA2\PhpDatasheet\Helper\EntityHelper;
use AlexanderA2\PhpDatasheet\Helper\ObjectHelper;
use AlexanderA2\PlatformBundle\Event\EntityDataBuildEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class EntityDataBuilder
{
    public function __construct(
        protected EntityManagerInterface   $entityManager,
        protected EntityHelper             $entityHelper,
        protected EventDispatcherInterface $eventDispatcher,
    ) {
    }

    public function getData($object): array
    {
        $data = [];
        $entityClassName = get_class($object);

        foreach ($this->entityHelper->getEntityFields($entityClassName) as $fieldName => $fieldType) {
            $data[] = [
                'name' => $fieldName,
                'value' => $this->getReadableValue($object, $fieldName, $fieldType),
            ];
        }
        $event = new EntityDataBuildEvent($object, $data);
        $this->eventDispatcher->dispatch($event);

        return $event->getData();
    }

    public function getReadableValue(mixed $object, string $fieldName, string $fieldType): string
    {
        if (empty($object)) {
            return '';
        }

        return call_user_func_array(
            [EntityHelper::resolveDataTypeByFieldType($fieldType), 'toString'],
            [ObjectHelper::getProperty($object, $fieldName)],
        );
    }
}