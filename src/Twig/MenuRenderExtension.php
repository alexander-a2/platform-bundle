<?php

namespace AlexanderA2\PlatformBundle\Twig;

use AlexanderA2\PlatformBundle\Event\MenuBuildEvent;
use Knp\Menu\ItemInterface;
use Knp\Menu\Matcher\Matcher;
use Knp\Menu\MenuFactory;
use Knp\Menu\Renderer\ListRenderer;
use Knp\Menu\Renderer\TwigRenderer;
use Psr\EventDispatcher\EventDispatcherInterface;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class MenuRenderExtension extends AbstractExtension
{
    public function __construct(
        protected EventDispatcherInterface $eventDispatcher,
        protected Environment              $twig,
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('build_menu', [$this, 'buildMenu'], ['is_safe' => ['html']]),
            new TwigFunction('render_menu', [$this, 'renderMenu'], ['is_safe' => ['html']]),
            new TwigFunction('render_sidebar_menu', [$this, 'renderSidebarMenu'], ['is_safe' => ['html']]),
        ];
    }

    public function buildMenu(string $name): ItemInterface
    {
        $event = new MenuBuildEvent($name, (new MenuFactory())->createItem($name));
        $this->eventDispatcher->dispatch($event);

        return $event->getMenu();
    }

    public function renderMenu(ItemInterface $menu): string
    {
        return (new ListRenderer(new Matcher()))->render($menu);
    }

    public function renderSidebarMenu(ItemInterface $menu): string
    {
        return (new TwigRenderer($this->twig, '@Platform/menu/sidebar_menu.html.twig', new Matcher()))
            ->render($menu);
    }
}