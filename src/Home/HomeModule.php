<?php

namespace App\Home;

use Framework\Module;
use Framework\Router;     
use App\Home\Actions\HomeAction;
use Framework\Renderer\RendererInterface;
class HomeModule extends Module
{
    const DEFINITIONS = __DIR__ . '/config.php';

    /**
     * __construct
     *
     * @param  mixed $prefix
     * @param  mixed $router
     * @param  mixed $renderer
     * @return void
     */
    public function __construct(string $prefix, Router $router, RendererInterface $renderer)
    {
        $renderer->addPath('home', __DIR__ . '/views');
        $router->get($prefix, HomeAction::class, 'home.index');
    }
}