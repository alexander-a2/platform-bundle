<?php

namespace AlexanderA2\PlatformBundle\EventSubscriber;

use AlexanderA2\PlatformBundle\Datasheet\Helper\EntityHelper;
use AlexanderA2\PlatformBundle\Datasheet\Helper\StringHelper;
use AlexanderA2\PlatformBundle\Builder\MenuBuilder;
use AlexanderA2\PlatformBundle\Controller\AdminController;
use AlexanderA2\PlatformBundle\Controller\CrudController;
use AlexanderA2\PlatformBundle\Event\MenuBuildEvent;
use AlexanderA2\PlatformBundle\Helper\RouteHelper;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Yaml\Yaml;

class AdminMenuEventSubscriber implements EventSubscriberInterface
{
    protected const MENU_NAME = 'sidebar_menu';
    protected const SUPPORTED_CONTROLLERS = [
        AdminController::class,
        CrudController::class,
    ];
    protected const PAGE_CONTROLS_MENU = [
        'page_controls_left',
        'page_controls_right',
    ];

    protected array $menuData = [];

    public function __construct(
        protected EntityHelper    $entityHelper,
        protected RouterInterface $router,
        protected RouteHelper     $routeHelper,
        protected RequestStack    $requestStack,
        protected MenuBuilder     $menuBuilder,
    ) {
        $yamlFilePath = __DIR__ . '/../Resources/config/menu.yaml';
        $this->menuData = Yaml::parse(file_get_contents($yamlFilePath));
    }

    public function onSidebarMenuBuild(MenuBuildEvent $event): void
    {
        if ($event->getMenu()->getName() !== self::MENU_NAME) {
            return;
        }

        if (!in_array($this->routeHelper->getCurrentController(), self::SUPPORTED_CONTROLLERS)) {
            return;
        }

        $databaseGroup = $event->getMenu()
            ->addChild('database')
            ->setLabel('a2platform.admin.menu.database.title')
            ->setExtra('icon', 'bi bi-grid-fill');

        foreach ($this->entityHelper->getEntityList() as $objectClassName) {
            $databaseGroup
                ->addChild($objectClassName)
                ->setLabel(StringHelper::getShortClassName($objectClassName))
                ->setUri($this->router->generate('admin_crud_index', [
                    'entityClassName' => $objectClassName,
                ]));
        }
    }

    public function onPageControlsBuild(MenuBuildEvent $event): void
    {
        if (!in_array($event->getMenu()->getName(), self::PAGE_CONTROLS_MENU)) {
            return;
        }

        if (!in_array($this->routeHelper->getCurrentController(), self::SUPPORTED_CONTROLLERS)) {
            return;
        }
        $this->menuBuilder->addMenuItems(
            $event->getMenu(),
            $this->menuData['admin'][$event->getMenu()->getName()][$this->routeHelper->getCurrentRoute()] ?? [],
            $this->requestStack->getCurrentRequest()->query->all(),
        );
    }

//    public function addLocaleItems(MenuBuildEvent $event): void
//    {
//        if ($event->getMenu()->getName() !== AdminBundle::MAIN_MENU_NAME) {
//            return;
//        }
//        $event->getMenu()->addChild(self::MENU_LOCALE_GROUP_TITLE, [
//            'label' => $this->translator->trans('admin.main_menu.' . self::MENU_LOCALE_GROUP_TITLE)
//        ]);
//
//        foreach ($this->parameters->get('kernel.enabled_locales') as $locale) {
//            $event->getMenu()
//                ->getChild(self::MENU_LOCALE_GROUP_TITLE)
//                ->addChild($locale)
//                ->setLabel($this->translator->trans('admin.locale.' . $locale))
//                ->setLabel($this->translator->trans('admin.locale.' . $locale))
//                ->setUri($this->router->generate('set_locale', [
//                    'locale' => $locale,
//                ]));
//        }
//    }

    public static function getSubscribedEvents(): array
    {
        return [
            MenuBuildEvent::class => [
                ['onSidebarMenuBuild'],
                ['onPageControlsBuild'],
//                ['addLocaleItems', -500],
            ],
        ];
    }
}