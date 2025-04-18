<?php

namespace App\Contact\Actions;

use Framework\Renderer\RendererInterface;

class ContactAction
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
        return $this->renderer->render('@contact/index');
    }
}