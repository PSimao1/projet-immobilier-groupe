<?php

namespace App\Home;


use Framework\Renderer\RendererInterface;
use Framework\Router;     
use Psr\Http\Message\ServerRequestInterface as Request; 


class HomeModule
{

    private $renderer;
    

    public function __construct(Router $router, RendererInterface $renderer)
    {

        $this->renderer = $renderer;

        $this->renderer->addPath('home', __DIR__ . '/views');

        $router->get('/', [$this, 'index'], 'home.index');
    }
    
    /**
     * Méthode pour afficher la page d'index du home (liste des articles)
     * 
     * @param Request $request - La requête HTTP
     * @return string - Le HTML généré
     */
    public function index(): string
    {
        
        return $this->renderer->render('@home/index');
    }
}