<?php

namespace Properties;

use App\Framework\Actions\CrudAction;
use App\Properties\Table\CategoryTable;
use Framework\Router;
use Framework\Session\FlashService;
use Framework\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

class CategoryCrudAction extends CrudAction
{
    protected $viewPath = "@properties/admin/categories";

    protected $routePrefix = "properties.category.admin";

    public function __construct(RendererInterface $renderer,
                                Router $router,
                                CategoryTable $table,
                                FlashService $flash)
    {
        parent::__construct($renderer, $router, $table, $flash);
    }

    protected function getParams(Request $request): array
    {
        return array_filter($request->getParsedBody(), function($key){
            return in_array($key, [
                'name', 'slug'
            ]);
            // on doit mettre tout pour la base de données??
        }, ARRAY_FILTER_USE_KEY);
    }

    protected function getValidator(Request $request)
    {
        return parent::getValidator($request)
            ->required('name', 'slug')
            ->length('name', 2, 250)
            ->length('slug', 2, 50)
            ->slug('slug');
    }
}