<?php

namespace AlexanderA2\PlatformBundle\Entity;

interface UserHasLocaleInterface
{
    public function getLocale(): ?string;

    public function setLocale(string $locale): self;
}