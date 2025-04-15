<?php

namespace App\Blog;


use Framework\Renderer\RendererInterface;
use Framework\Router;     
use Psr\Http\Message\ServerRequestInterface as Request; 


class BlogModule
{

    private $renderer;
    

    public function __construct(Router $router, RendererInterface $renderer)
    {

        $this->renderer = $renderer;

        $this->renderer->addPath('blog', __DIR__ . '/views');

        $router->get('/blog', [$this, 'index'], 'blog.index');
        
        $router->get('/blog/{slug}', [$this, 'show'], 'blog.show');
    }
    
    /**
     * Méthode pour afficher la page d'index du blog (liste des articles)
     * 
     * @param Request $request - La requête HTTP
     * @return string - Le HTML généré
     */
    public function index(): string
    {
        
        return $this->renderer->render('@blog/index');
    }
    
    /**
     * Méthode pour afficher un article spécifique
     * 
     * @param Request $request - La requête HTTP
     * @return string - Le HTML généré
     */
    public function show(Request $request): string
    {
    
        return $this->renderer->render('@blog/show', [

            'slug' => $request->getAttribute('slug')
        ]);
    }
}