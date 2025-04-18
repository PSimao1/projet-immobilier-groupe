<?php

namespace App\Account\Actions;

use Framework\Renderer\RendererInterface;

class AccountAction
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
        return $this->renderer->render('@account/index');
    }
}