<?php

namespace App\Properties\Actions;

use App\Blog\Entity\Post;
use App\Framework\Actions\CrudAction;
use Framework\Router;
use Framework\Validator;
use Framework\Session\FlashService;
use App\Properties\Table\PropertyTable;
use Framework\Actions\RouterAwareAction;
use Framework\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

class PostCrudAction extends CrudAction
{
    protected $viewPath = "@properties/admin/posts";

    protected $routePrefix = "properties.admin";

    public function __construct(RendererInterface $renderer,
                                Router $router,
                                PropertyTable $table,
                                FlashService $flash)
    {
        parent::__construct($renderer, $router, $table, $flash);
    }

    protected function getNewEntity()
    {
        $post = new Post();
        $post->created_at = new \DateTime();
        return $post;
    }


    protected function getParams(ServerRequestInterface $request)
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

    protected function getValidator(Request $request)
    {
        return parent::getValidator($request)
            ->required('description', 'title', 'slug')
            ->length('description', 10)
            ->length('title', 2, 250)
            ->length('slug', 2, 50)
            ->slug('slug');
    }

}