<?php

namespace AlexanderA2\PlatformBundle\EventSubscriber;

use AlexanderA2\PhpDatasheet\Helper\EntityHelper;
use AlexanderA2\PhpDatasheet\Helper\StringHelper;
use AlexanderA2\PlatformBundle\Event\MenuBuildEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class AdminMenuEventSubscriber implements EventSubscriberInterface
{
    private const ADMIN_SIDEBAR_MENU_NAME = 'admin_sidebar';

    public function __construct(
        protected EntityHelper    $entityHelper,
        protected RouterInterface $router,
//        protected EntityManagerInterface $entityManager,
//        protected ParameterBagInterface  $parameters,
//        protected TranslatorInterface    $translator,
    )
    {
    }

    public function addEntityItems(MenuBuildEvent $event): void
    {
        if ($event->getMenu()->getName() !== self::ADMIN_SIDEBAR_MENU_NAME) {
            return;
        }

        $databaseGroup = $event->getMenu()
            ->addChild('database')
            ->setLabel('a2platform.admin.menu.database.title')
            ->setExtra('icon', 'bi bi-grid-fill');
//        $general->addChild('about')
//            ->setLabel('website.menu.general.about')
//            ->setUri($this->router->generate('about'));
//
//
//        $event->getMenu()->addChild(self::HOME_PAGE_ITEM_NAME)
//            ->setLabel(self::HOME_PAGE_ITEM_NAME)
//            ->
//            ->setUri('/');
//        $event->getMenu()->addChild(self::ADMIN_PAGE_ITEM_NAME)
//            ->setLabel(self::ADMIN_PAGE_ITEM_NAME)
//            ->setUri($this->router->generate('admin_index'));
//
//        $event->getMenu()->addChild(self::MENU_ENTITY_LIST_GROUP_TITLE, [
//            'label' => self::MENU_ENTITY_LIST_GROUP_TITLE,
//        ]);
//
        foreach ($this->entityHelper->getEntityList() as $objectClassName) {
            $databaseGroup
                ->addChild($objectClassName)
                ->setLabel(StringHelper::getShortClassName($objectClassName))
                ->setUri($this->router->generate('admin_crud_index', [
                    'entityClassName' => $objectClassName,
                ]));
        }
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
                ['addEntityItems', 500],
//                ['addLocaleItems', -500],
            ],
        ];
    }
}