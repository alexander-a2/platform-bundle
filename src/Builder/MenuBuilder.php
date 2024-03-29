<?php

namespace AlexanderA2\PlatformBundle\Builder;

use AlexanderA2\PlatformBundle\Event\MenuBuildEvent;
use Knp\Menu\ItemInterface;
use Knp\Menu\MenuFactory;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class MenuBuilder
{
    public function __construct(
        protected EventDispatcherInterface $eventDispatcher,
    ) {
    }

    public function build(string $name): ItemInterface
    {
        $event = new MenuBuildEvent($name, (new MenuFactory())->createItem($name));
        $this->eventDispatcher->dispatch($event);

        return $event->getMenu();
    }
}