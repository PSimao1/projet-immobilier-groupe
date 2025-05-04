<?php

namespace App\Framework\Twig;

use Twig\TwigFunction;
use Framework\Session\FlashService;
use Twig\Extension\AbstractExtension;

class FlashExtension extends AbstractExtension
{
    public function __construct(Private FlashService $flashService)
    {

    }

    public function getFunctions(): array
    {
        return  [
            new TwigFunction('flash', [$this, 'getFlash'])
        ];
    }

    public function getFlash($type): ?string
    {
        return $this->flashService->get($type);
    }
}