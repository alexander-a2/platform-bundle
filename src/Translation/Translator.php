<?php

namespace AlexanderA2\PlatformBundle\Translation;

use AlexanderA2\PlatformBundle\Datasheet\Helper\StringHelper;
use Symfony\Component\Translation\TranslatorBagInterface;
use Symfony\Contracts\Translation\LocaleAwareInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class Translator// implements// TranslatorInterface, LocaleAwareInterface // TranslatorBagInterface
{
    public function __construct(private TranslatorInterface $translator)
    {
    }

    public function trans(string $id, array $parameters = [], string $domain = null, string $locale = null): string
    {
        $translated = $this->translator->trans($id, $parameters, $domain, $locale);

        if ($translated !== $id) {
            return $translated;
        }

        if (!str_contains($id, '.')) {
            return StringHelper::toReadable($id);
        }

        return $id;
    }

    public function getLocale(): string
    {
        return $this->translator->getLocale();
    }

    public function setLocale(string $locale)
    {
        return $this->translator->setLocale($locale);
    }
}