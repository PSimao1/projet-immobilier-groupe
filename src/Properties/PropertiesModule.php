<?php

namespace App\Properties;

use Framework\Module;
use Framework\Router;     
use Properties\CategoryCrudAction;
use Psr\Container\ContainerInterface;
use Framework\Renderer\RendererInterface;
use App\Properties\Actions\PostCrudAction;
use App\Properties\Actions\PropertiesAction;

class PropertiesModule extends Module
{
    const DEFINITIONS = __DIR__ . '/config.php';
    const MIGRATIONS = __DIR__ . '/db/migrations';
    const SEEDS = __DIR__ . '/db/seeds';


    public function __construct(ContainerInterface $container)
    {
        $propertiesPrefix = $container->get('properties.prefix');
        $container->get(RendererInterface::class)->addPath('properties', __DIR__ . '/views');
        $router = $container->get(Router::class);
        $router->get($propertiesPrefix, PropertiesAction::class, 'properties.index');
        $router->get($propertiesPrefix . '/{slug}', PropertiesAction::class, 'properties.show');

        if($container->has('admin.prefix')){
            $prefix = $container->get('admin.prefix');
            $router->crud("$prefix/properties",PostCrudAction::class, 'properties.admin');
            $router->crud("$prefix/categories",CategoryCrudAction::class, 'properties.category.admin');
        }
    }
}