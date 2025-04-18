<?php

namespace App\Properties\Actions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Framework\Renderer\RendererInterface;

class PropertiesAction
{
    public function __construct(
        private RendererInterface $renderer
    ){}

    public function __invoke(Request $request)
    {
        $slug = $request->getAttribute('slug');

        if ($slug) 
        {
            return $this->show($slug);
        }

        return $this->index();
    }

    public function index (): string
    {
        return $this->renderer->render('@properties/index');
    }

    public function show(string $slug): string
    {
        return $this->renderer->render('@properties/show', [
            'slug' => $slug
        ]);
    }
}