<?php

namespace App\About\Actions;

use Framework\Renderer\RendererInterface;

class AboutAction
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
        return $this->renderer->render('@about/index');
    }
}