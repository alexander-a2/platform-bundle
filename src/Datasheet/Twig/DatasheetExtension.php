<?php

namespace AlexanderA2\PlatformBundle\Datasheet\Twig;

use AlexanderA2\PlatformBundle\Datasheet\DatasheetInterface;
use AlexanderA2\PlatformBundle\Datasheet\Builder\DatasheetBuilder;
use Symfony\Component\HttpFoundation\RequestStack;
use Throwable;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class DatasheetExtension extends AbstractExtension
{
    public function __construct(
        protected Environment      $twig,
        protected RequestStack     $requestStack,
        protected DatasheetBuilder $datasheetBuilder,
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('datasheet', [$this, 'renderDatasheet'], ['is_safe' => ['html']]),
        ];
    }

    public function renderDatasheet(DatasheetInterface $datasheet): string
    {
        try {
            $this->datasheetBuilder->build(
                $datasheet,
                $this->requestStack->getMainRequest()->query->all($datasheet->getName()),
            );

            return $this->twig->render('@Platform/datasheet/layout.html.twig', [
                'datasheet' => $datasheet,
            ]);
        } catch (Throwable $exception) {
            return $this->twig->render('@Platform/datasheet/exception.html.twig', [
                'datasheet' => $datasheet,
                'exception' => $exception,
                'trace' => $exception->getTraceAsString(),
            ]);
        }
    }
}