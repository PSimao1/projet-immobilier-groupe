<?php

namespace App\Properties\Actions;

use Framework\Router;
use App\Properties\Table\PropertyTable;
use Framework\Actions\RouterAwareAction;
use Framework\Renderer\RendererInterface;
use Framework\Session\FlashService;
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
            $this->flash->success('L\'article a bien été modifié');
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
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            $this->propertyTable->insert($params);
            $this->flash->success('L\'article a bien été créé');

            return $this->redirect('properties.admin.index');
        }
        $item = [];
        return $this->renderer->render('@properties/admin/create', compact('item'));
    }

    public function delete(Request $request)
    {
        $this->propertyTable->delete($request->getAttribute('id'));
        $this->flash->success('La propriété a bien été supprimée');
        return $this->redirect('properties.admin.index');
    }

    function getParams(Request $request)
    {
        return array_filter($request->getParsedBody(), function($key){
            return in_array($key, [
                'slug', 'title', 'description', 'price', 'area', 'rooms', 'carrez',
                'prefix_area', 'land_area', 'bedrooms', 'bathrooms', 'garages',
                'construction_year', 'ac', 'swimming_pool', 'lawn', 'barbecue',
                'microwave', 'television', 'dryer', 'outdoor_shower', 'washer',
                'gym', 'fridge', 'wifi', 'laundry', 'sauna', 'windows_curtains',
                'adress', 'zip_code', 'city', 'country', 'longitude', 'latitude'
            ]);
            // on doit mettre tout pour la base de données??
        }, ARRAY_FILTER_USE_KEY);
    }

}