<?php

namespace App\Properties\Actions;

use Framework\Router;
use App\Properties\Table\PropertyTable;
use Framework\Actions\RouterAwareAction;
use Framework\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

class AdminPropertiesAction
{
    use RouterAwareAction;

    public function __construct(
        private RendererInterface $renderer,
        private Router $router,
        private PropertyTable $propertyTable
    ){}  

    public function __invoke(Request $request)
    {
        if($request->getMethod()==='DELETE'){
            return $this->delete($request);
        }
        if(substr((string)$request->getUri(), -3)==='new'){
            return $this->create($request);
        }
        if($request->getAttribute('id')){
            return $this->edit($request);
        }
        return $this->index($request);
    }

    public function index(Request $request)
    {
        $params = $request->getQueryParams();
        $items = $this->propertyTable->findPaginated(12, $params['p' ] ?? 1);
        return $this->renderer->render('@properties/admin/index', compact('items'));
    }

    public function edit(Request $request)
    {
        $item = $this->propertyTable->find($request->getAttribute('id'));
        if($request->getMethod()=== 'POST'){
            $params = $this->getParams($request);
            $params['updated_at'] = date('Y-m-d H:i:s');
            $this->propertyTable->update($item->id, $params);
            return $this->redirect('properties.admin.index');

        }
        return $this->renderer->render('@properties/admin/edit', compact('item'));
    }

    public function create(Request $request) 
    {
        if($request->getMethod()=== 'POST'){
            $params = $this->getParams($request);
            $params = array_merge($params, [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            $this->propertyTable->insert($params);
            return $this->redirect('properties.admin.index');
        }
        $item = [];
        return $this->renderer->render('@properties/admin/create', compact('item'));
    }

    public function delete(Request $request) 
    {
        $this->propertyTable->delete($request->getAttribute('id'));
        return $this->redirect('properties.admin.index');
    }

    function getParams(Request $request)
    {
        return array_filter($request->getParsedBody(), function($key){
            return in_array($key, ['name', 'slug', 'title','bedrooms', 'bathrooms', 'price','adress','city','country']); // on  doit mettre tout pour la base de données??
        }, ARRAY_FILTER_USE_KEY);
    }
    
}