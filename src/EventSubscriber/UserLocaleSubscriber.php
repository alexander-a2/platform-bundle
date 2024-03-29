<?php

namespace AlexanderA2\PlatformBundle\EventSubscriber;

use AlexanderA2\PlatformBundle\Entity\UserHasLocaleInterface;
use AlexanderA2\SymfonyBasics\Exception\ConfigException;
use App\Entity\User;
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

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'setLocale',
        ];
    }

    public function setLocale(ControllerEvent $event)
    {
        if(!$this->security->getUser() instanceof UserHasLocaleInterface){
            return;
        }
//        $this->checkSetup($this->security->getUser());
//        $locale = $this->security->getUser()?->getLocale();
//        $event->getRequest()->setLocale($locale ?? $this->parameters->get('kernel.default_locale'));
//        $this->translator->setLocale($locale ?? $this->parameters->get('kernel.default_locale'));
//        } else if ($preferredLanguage = $request->getPreferredLanguage()) {
//           $locale = current(explode('_', $preferredLanguage));
    }

    public static function checkSetup(?User $user = null): void
    {
        if(!$user){
            return;
        }

        if (!method_exists($user, 'getLocale')) {
            throw new ConfigException('For Basics/Localization User should have getLocale() method');
        }

        if (!method_exists($user, 'setLocale')) {
            throw new ConfigException('For Basics/Localization User should have setLocale() method');
        }
    }
}