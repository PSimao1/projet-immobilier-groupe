<?php

namespace App\Home\Actions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Framework\Renderer\RendererInterface;

class HomeAction
{

    public function __construct(
        private RendererInterface $renderer
    ){}

    public function __invoke(Request $request)
    {
        return $this->index();
    }

    public function index(): string
    {
        return $this->renderer->render('@home/index');
    }
}