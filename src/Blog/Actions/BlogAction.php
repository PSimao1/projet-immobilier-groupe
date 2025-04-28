<?php

namespace App\Blog\Actions;

use Framework\Router;
use App\Blog\Table\BlogTable;
use Framework\Actions\RouterAwareAction;
use Framework\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
class BlogAction
{
    /**
     * @var RendererInterface
     */
    private $renderer;

    /**
     * @var Router
     */
    private $router;
    /**
     * @var BlogTable
     */
    private $blogTable;

    use RouterAwareAction;

    public function __construct(RendererInterface $renderer, Router $router, BlogTable $blogTable)
    {
        $this->renderer = $renderer;
        $this->router = $router;
        $this->blogTable = $blogTable;
    }

    public function __invoke(Request $request)
    {
        if ($request->getAttribute('slug')) {
            return $this->show($request);
        }
        return $this->index($request);
    }

    public function index (Request $request): string
    {
        $params= $request->getQueryParams();
        $items = $this->blogTable->findPaginated(6, $params['p'] ?? 1);

        return $this->renderer->render('@blog/index', compact('items'));
    }
    
    
    public function show(Request $request)
    {
        $slug = $request->getAttribute('slug');
        $blog = $this->blogTable->find($request->getAttribute('slug'));
        return $this->renderer->render('@blog/show', [
            'items' => $blog,
        ]);
    }
}