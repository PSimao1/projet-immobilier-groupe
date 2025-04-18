<?php

namespace App\Cart\Actions;

use Framework\Renderer\RendererInterface;

class CartAction
{

    public function __construct(
        private RendererInterface $renderer
    ){}

    public function __invoke()
    {
        return $this->index();
    }

    public function index(): string
    {
        return $this->renderer->render('@cart/index');
    }
}