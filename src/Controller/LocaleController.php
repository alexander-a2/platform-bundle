<?php

namespace AlexanderA2\PlatformBundle\Controller;

use AlexanderA2\PlatformBundle\Entity\UserHasLocaleInterface;
use AlexanderA2\PlatformBundle\Helper\ControllerHelper;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class LocaleController extends AbstractController
{
    public function __construct(
        protected array $availableLocales = [],
    ) {
    }

    #[Route('set-locale/{locale}', name: 'set_locale')]
    public function setLocaleAction(
        EntityManagerInterface $entityManager,
        ControllerHelper       $controllerHelper,
                               $locale,
    ): Response {
        $user = $this->getUser();

        if (!$user instanceof UserHasLocaleInterface) {
            throw new Exception('User entity must implement UserHasLocaleInterface');
        }

        if (in_array($locale, $this->availableLocales)) {
            $user->setLocale($locale);
            $entityManager->flush();
        }

        return $controllerHelper->redirectBack();
    }
}