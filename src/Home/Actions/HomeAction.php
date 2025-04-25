<?php

namespace App\Home\Actions;

use Framework\Router;
use App\Home\Table\HomeTable;
use Framework\Actions\RouterAwareAction;
use Framework\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeAction
{
    use RouterAwareAction;
    
    public function __construct(
        private RendererInterface $renderer,
        private Router $router, 
        private HomeTable $homeTable)
        {}

    public function __invoke(Request $request)
    {
        return $this->index();
    }

    public function index(): string
    {
        $properties = $this->homeTable->showSixProperty();
        $blog = $this->homeTable->showThreeBlog();

        return $this->renderer->render('@home/index', [
            'property'=> $properties,
            'blog'=> $blog
        ]);
    }
}



