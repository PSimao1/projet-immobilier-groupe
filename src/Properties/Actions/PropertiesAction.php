<?php

namespace App\Properties\Actions;

use Framework\Router;
use App\Properties\Table\PropertyTable;
use Framework\Actions\RouterAwareAction;
use Framework\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

class PropertiesAction
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
     * @var PropertyTable
     */
    private $propertyTable;

    use RouterAwareAction;

    public function __construct(RendererInterface $renderer, Router $router, PropertyTable $propertyTable)
    {
        $this->renderer = $renderer;
        $this->router = $router;
        $this->propertyTable = $propertyTable;
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
        $items = $this->propertyTable->findPaginated(12, $params['p'] ?? 1);

        return $this->renderer->render('@properties/index', compact('items'));
    }
    
    
    public function show(Request $request)
    {
        $slug = $request->getAttribute('slug');
        $properties = $this->propertyTable->find($request->getAttribute('slug'));
        return $this->renderer->render('@properties/show', [
            'items' => $properties,
        ]);
    }
}