<?php

namespace App\Properties;


use Framework\Renderer\RendererInterface;
use Framework\Router;     
use Psr\Http\Message\ServerRequestInterface as Request; 


class PropertiesModule
{

    private $renderer;
    

    public function __construct(Router $router, RendererInterface $renderer)
    {

        $this->renderer = $renderer;

        $this->renderer->addPath('properties', __DIR__ . '/views');

        $router->get('/properties', [$this, 'index'], 'properties.index');
        
        $router->get('/properties/{slug}', [$this, 'show'], 'properties.show');
    }
    
    /**
     * Méthode pour afficher la page d'index du properties (liste des articles)
     * 
     * @param Request $request - La requête HTTP
     * @return string - Le HTML généré
     */
    public function index(): string
    {
        
        return $this->renderer->render('@properties/index');
    }
    
    /**
     * Méthode pour afficher un article spécifique
     * 
     * @param Request $request - La requête HTTP
     * @return string - Le HTML généré
     */
    public function show(Request $request): string
    {
    
        return $this->renderer->render('@properties/show', [

            'slug' => $request->getAttribute('slug')
        ]);
    }
}