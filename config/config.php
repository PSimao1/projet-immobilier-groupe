<?php

use App\Framework\Twig\PagerFantaExtension;
use Framework\Renderer\RendererInterface;
use Framework\Router\RouterTwigExtension;
use Framework\Renderer\TwigRendererFactory;

return [
    'database.host' => 'localhost',
    'database.username' => 'root',
    'database.password' => '',
    'database.name' => 'cityscape',
    'views.path' => dirname(__DIR__) . '/views',
    'twig.extensions' => [
        \DI\get(RouterTwigExtension::class),
        \DI\get(PagerfantaExtension::class)
    ],
    \Framework\Router::class => \DI\autowire(),
    RendererInterface::class => \DI\factory(TwigRendererFactory::class),
    \PDO::class => function (\Psr\Container\ContainerInterface $c) 
    {
        return new PDO(
            'mysql:host=' . $c->get('database.host') . ';dbname=' . $c->get('database.name'),
            $c->get('database.username'),
            $c->get('database.password'),
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    }
];