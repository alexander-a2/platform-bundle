<?php

namespace AlexanderA2\PlatformBundle\Event;

use Knp\Menu\ItemInterface;

class MenuBuildEvent
{
    public function __construct(
        protected string $name,
        protected ItemInterface $menu
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getMenu(): ItemInterface
    {
        return $this->menu;
    }
}