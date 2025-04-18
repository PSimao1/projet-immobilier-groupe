<?php

namespace App\Blog\Actions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Framework\Renderer\RendererInterface;

class BlogAction
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
        return $this->renderer->render('@blog/index');
    }

    public function show(string $slug): string
    {
        return $this->renderer->render('@blog/show', [
            'slug' => $slug
        ]);
    }
}