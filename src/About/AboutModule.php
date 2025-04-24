<?php

namespace App\About;


use Framework\Module;
use Framework\Router;     
use App\About\Actions\AboutAction;
use Framework\Renderer\RendererInterface;


class AboutModule extends Module
{
    const DEFINITIONS = __DIR__ . '/config.php';
    const MIGRATIONS = __DIR__ . '/db/migrations';
    const SEEDS = __DIR__ . '/db/seeds';

    public function __construct(string $prefix, Router $router, RendererInterface $renderer)
    {

        $renderer->addPath('about', __DIR__ . '/views');
        $router->get($prefix, AboutAction::class, 'about.index');
    }
    
}