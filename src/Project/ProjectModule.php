<?php

namespace App\Project;


use Framework\Renderer\RendererInterface;
use Framework\Router;     
use Psr\Http\Message\ServerRequestInterface as Request; 


class ProjectModule
{

    private $renderer;
    

    public function __construct(Router $router, RendererInterface $renderer)
    {

        $this->renderer = $renderer;

        $this->renderer->addPath('project', __DIR__ . '/views');

        $router->get('/project', [$this, 'index'], 'project.index');
    }
    
    /**
     * Méthode pour afficher la page d'index du project (liste des articles)
     * 
     * @param Request $request - La requête HTTP
     * @return string - Le HTML généré
     */
    public function index(): string
    {
        
        return $this->renderer->render('@project/index');
    }
}