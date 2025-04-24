<?php

namespace App\Properties;

use Framework\Module;
use Framework\Router;     
use Framework\Renderer\RendererInterface;
use App\Properties\Actions\PropertiesAction;
class PropertiesModule extends Module
{
    const DEFINITIONS = __DIR__ . '/config.php';
    const MIGRATIONS = __DIR__ . '/db/migrations';
    const SEEDS = __DIR__ . '/db/seeds';

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
        $renderer->addPath('properties', __DIR__ . '/views');
        $router->get($prefix, PropertiesAction::class, 'properties.index');
        $router->get($prefix . '/{slug}', PropertiesAction::class, 'properties.show');
    }
}