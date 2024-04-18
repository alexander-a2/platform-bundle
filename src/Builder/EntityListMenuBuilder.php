<?php

namespace AlexanderA2\PlatformBundle\Builder;

use AlexanderA2\PlatformBundle\Datasheet\Helper\EntityHelper;
use AlexanderA2\PlatformBundle\Datasheet\Helper\StringHelper;
use Knp\Menu\ItemInterface;
use Symfony\Component\Routing\RouterInterface;

class EntityListMenuBuilder
{
    public function __construct(
        protected EntityHelper    $entityHelper,
        protected RouterInterface $router,
    ) {
    }

    public function addMenItems(ItemInterface $menu): void
    {
        foreach ($this->entityHelper->getEntityList() as $objectClassName) {
            $menu
                ->addChild($objectClassName)
                ->setLabel(StringHelper::getShortClassName($objectClassName))
                ->setUri($this->router->generate('admin_crud_index', [
                    'entityClassName' => $objectClassName,
                ]));
        }
    }
}