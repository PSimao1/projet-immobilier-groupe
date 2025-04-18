<?php

namespace App\Faq\Actions;

use Framework\Renderer\RendererInterface;

class FaqAction
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
        return $this->renderer->render('@faq/index');
    }
}