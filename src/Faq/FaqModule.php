<?php

namespace App\Faq;


use Framework\Renderer\RendererInterface;
use Framework\Router;     
use Psr\Http\Message\ServerRequestInterface as Request; 


class FaqModule
{

    private $renderer;
    

    public function __construct(Router $router, RendererInterface $renderer)
    {

        $this->renderer = $renderer;

        $this->renderer->addPath('faq', __DIR__ . '/views');

        $router->get('/faq', [$this, 'index'], 'faq.index');
    }
    
    /**
     * Méthode pour afficher la page d'index du faq (liste des articles)
     * 
     * @param Request $request - La requête HTTP
     * @return string - Le HTML généré
     */
    public function index(): string
    {
        
        return $this->renderer->render('@faq/index');
    }
}