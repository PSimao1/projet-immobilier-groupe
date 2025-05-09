<?php

namespace App\Properties\Actions;

use App\Blog\Entity\Post;
use App\Framework\Actions\CrudAction;
use App\Properties\Table\CategoryTable;
use Framework\Router;
use Framework\Session\FlashService;
use App\Properties\Table\PropertyTable;
use Framework\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

class PostCrudAction extends CrudAction
{
    protected $viewPath = "@properties/admin/posts";

    protected $routePrefix = "properties.admin";
    
    /**
     *
     * @var CategoryTable
     */
    private $categoryTable;

    public function __construct(RendererInterface $renderer,
                                Router $router,
                                PropertyTable $table,
                                FlashService $flash,
                                CategoryTable $categoryTable)
    {
        parent::__construct($renderer, $router, $table, $flash);
        $this->categoryTable = $categoryTable;
    }

    protected function formParams(array $params): array
    {
        $params['categories'] = $this->categoryTable->findList(); 
        $params['categories'] ['12312323']= 'Categorie fake';
        return $params;
    }


    protected function getNewEntity()
    {
        $post = new Post();
        $post->created_at = new \DateTime();
        return $post;
    }

    protected function getParams(Request $request): array
    {
        $params= array_filter($request->getParsedBody(), function($key){
            return in_array($key, [
                'slug', 'title', 'description', 'category_id','created_at', 'price', 'area', 'rooms', 'carrez',
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
            ->required('description', 'title', 'slug', 'category_id')
            ->length('description', 10)
            ->length('title', 2, 250)
            ->length('slug', 2, 50)
            ->exists('category_id', $this->categoryTable->getTable(), $this->categoryTable->getPdo())
            ->slug('slug');
    }

}