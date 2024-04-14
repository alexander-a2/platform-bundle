<?php

namespace AlexanderA2\PlatformBundle\EventSubscriber;

use AlexanderA2\PlatformBundle\Entity\UserHasLocaleInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Contracts\Translation\TranslatorInterface;

class UserLocaleSubscriber implements EventSubscriberInterface
{
    public function __construct(
        protected TranslatorInterface   $translator,
        protected Security              $security,
        protected ParameterBagInterface $parameters,
    ) {
    }

    public function setLocale(ControllerEvent $event): void
    {
        if (!$this->security->getUser() instanceof UserHasLocaleInterface) {
            return;
        }
        $userLocale = $this->security->getUser()->getLocale();

        if (!in_array($userLocale, $this->parameters->get('kernel.enabled_locales'))) {
            return;
        }
        $event->getRequest()->setLocale($userLocale);
        $this->translator->setLocale($userLocale);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'setLocale',
        ];
    }
}