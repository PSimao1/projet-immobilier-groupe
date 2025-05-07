<?php

namespace App\Properties\Actions;

use Framework\Router;
use Framework\Validator;
use Framework\Session\FlashService;
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
        private PropertyTable $propertyTable,
        private FlashService $flash
    ){}

    public function __invoke(Request $request)
    {
        if($request->getMethod()==='DELETE'){
            return $this->delete($request);
        }
        if(substr((string)$request->getUri(), -3) ==='new'){
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
        $items = $this->propertyTable->findPaginated(12, $params['p'] ?? 1);
        
        return $this->renderer->render('@properties/admin/index', compact('items'));
    }

    public function edit(Request $request)
    {
        $item = $this->propertyTable->find($request->getAttribute('id'));
        $errors= [];

        if ($request->getMethod() === 'POST') {
            $params = $this->getParams($request);
            $validator = $this->getValidator($request);
            if ($validator->isValid()) {
                $this->propertyTable->update($item->id, $params);
                $this->flash->success('L\'article a bien été modifié');
                return $this->redirect('properties.admin.index');
            }
            $errors = $validator->getErrors();
            $params['id'] = $item->id;
            $item = $params;
        }

        return $this->renderer->render('@properties/admin/edit', compact('item', 'errors'));
    }

    public function create(Request $request)
    {
        $item= [];
        $errors= [];
        if($request->getMethod()=== 'POST'){
            $params = $this->getParams($request);
            $validator = $this->getValidator($request);
            if ($validator->isValid()) {
                $this->propertyTable->insert($params);
                $this->flash->success('L\'article a bien été créé');
                return $this->redirect('properties.admin.index');
            }
            $item = $params;
            $errors = $validator->getErrors();  
        }

        return $this->renderer->render('@properties/admin/create', compact('item', 'errors'));
    }

    public function delete(Request $request)
    {
        $this->propertyTable->delete($request->getAttribute('id'));
        $this->flash->success('La propriété a bien été supprimée');
        return $this->redirect('properties.admin.index');
    }

    private function getParams(Request $request)
    {
        $params= array_filter($request->getParsedBody(), function($key){
            return in_array($key, [
                'slug', 'title', 'description', 'created_at', 'price', 'area', 'rooms', 'carrez',
                'prefix_area', 'land_area', 'bedrooms', 'bathrooms', 'garages',
                'construction_year', 'ac', 'swimming_pool', 'lawn', 'barbecue',
                'microwave', 'television', 'dryer', 'outdoor_shower', 'washer',
                'gym', 'fridge', 'wifi', 'laundry', 'sauna', 'windows_curtains',
                'adress', 'zip_code', 'city', 'country', 'longitude', 'latitude'
            ]);
            // on doit mettre tout pour la base de données??
        }, ARRAY_FILTER_USE_KEY);
        return array_merge($params, [
            'updated_at'=> date('Y-m-d H:i:s')
        ]);
    }

    private function getValidator(Request $request)
    {
        return (new Validator($request->getParsedBody()))
            ->required('description', 'title', 'slug')
            ->length('description', 10)
            ->length('title', 2, 250)
            ->length('slug', 2, 50)
            ->slug('slug');
    }

}