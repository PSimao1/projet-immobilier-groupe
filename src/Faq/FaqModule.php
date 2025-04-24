<?php

namespace App\Faq;

use Framework\Module;
use Framework\Router;     
use App\Faq\Actions\FaqAction;
use Framework\Renderer\RendererInterface;
class FaqModule extends Module
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

        $renderer->addPath('faq', __DIR__ . '/views');
        $router->get($prefix, FaqAction::class, 'faq.index');
    }
    
}