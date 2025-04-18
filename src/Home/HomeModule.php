<?php

namespace App\Home;


use Framework\Module;
use Framework\Router;     
use App\Home\Actions\HomeAction;
use Framework\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface as Request; 


class HomeModule extends Module
{
    const DEFINITIONS = __DIR__ . '/config.php';


    public function __construct(string $prefix, Router $router, RendererInterface $renderer)
    {

        $renderer->addPath('home', __DIR__ . '/views');
        $router->get('/', HomeAction::class, 'home.index');
    }
    
}