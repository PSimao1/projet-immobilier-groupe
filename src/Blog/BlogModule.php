<?php

namespace App\Blog;


use Framework\Module;
use Framework\Router;     
use App\Blog\Actions\BlogAction;
use Framework\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface as Request; 


class BlogModule extends Module
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

        $renderer->addPath('blog', __DIR__ . '/views');
        $router->get($prefix, BlogAction::class, 'blog.index');
        $router->get($prefix . '/{slug}', BlogAction::class, 'blog.show');
  
    }
}