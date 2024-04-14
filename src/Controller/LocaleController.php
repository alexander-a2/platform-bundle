<?php

namespace AlexanderA2\PlatformBundle\Controller;

use AlexanderA2\PlatformBundle\Entity\UserHasLocaleInterface;
use AlexanderA2\PlatformBundle\Helper\RouteHelper;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LocaleController extends AbstractController
{
    #[Route('set-locale/{locale}', name: 'set_locale')]
    public function setLocaleAction(
        EntityManagerInterface $entityManager,
        RouteHelper            $controllerHelper,
                               $locale,
    ): Response {
        $user = $this->getUser();

        if (!$user instanceof UserHasLocaleInterface) {
            throw new Exception('User entity must implement UserHasLocaleInterface');
        }

        if (in_array($locale, $this->getParameter('kernel.enabled_locales'))) {
            $user->setLocale($locale);
            $entityManager->flush();
        }

        return $controllerHelper->redirectBack();
    }
}