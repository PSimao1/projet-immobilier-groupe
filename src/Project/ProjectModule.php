<?php

namespace App\Project;


use Framework\Module;
use Framework\Router;     

use App\Project\Actions\ProjectAction;
use Framework\Renderer\RendererInterface;



class ProjectModule extends Module
{

    const DEFINITIONS = __DIR__ . '/config.php';



    public function __construct(string $prefix, Router $router, RendererInterface $renderer)
    {

        $renderer->addPath('project', __DIR__ . '/views');
        $router->get($prefix, ProjectAction::class, 'project.index');
        $router->get($prefix . '/{slug}', ProjectAction::class, 'project.show');
  
    }
}