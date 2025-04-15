<?php

namespace App\About;


use Framework\Renderer\RendererInterface;
use Framework\Router;     
use Psr\Http\Message\ServerRequestInterface as Request; 


class AboutModule
{

    private $renderer;
    

    public function __construct(Router $router, RendererInterface $renderer)
    {

        $this->renderer = $renderer;

        $this->renderer->addPath('about', __DIR__ . '/views');

        $router->get('/about', [$this, 'index'], 'about.index');
    }
    
    /**
     * Méthode pour afficher la page d'index du about (liste des articles)
     * 
     * @param Request $request - La requête HTTP
     * @return string - Le HTML généré
     */
    public function index(): string
    {
        
        return $this->renderer->render('@about/index');
    }
}