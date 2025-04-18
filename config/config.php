<?php

use Framework\Renderer\RendererInterface;
use Framework\Router\RouterTwigExtension;
use Framework\Renderer\TwigRendererFactory;

return [
    'views.path' => dirname(__DIR__) . '/views',
    'twig.extensions' => [
        \DI\get(RouterTwigExtension::class)
    ],
    \Framework\Router::class => \DI\autowire(),
    RendererInterface::class => \DI\factory(TwigRendererFactory::class),
];