<?php

namespace App\Framework\Actions;

use Framework\Router;
use Framework\Validator;
use App\Framework\Database\Table;
use Framework\Session\FlashService;
use App\Properties\Table\PropertyTable;
use Psr\Http\Message\ResponseInterface;
use Framework\Actions\RouterAwareAction;
use Framework\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

class CrudAction
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
     * @var Table
     */
    private $table;

    /**
     * @var FlashService
     */
    private $flash;

    /**
     * @var string
     */
    protected $viewPath;

    /**
     * @var string
     */
    protected $routePrefix;

    /**
     * @var string
     */
    protected $messages = [
        'create' => "L'élément a bien été créé",
        'edit' => "L'élément a bien été modifié"
    ];

    use RouterAwareAction;

    public function __construct(
         RendererInterface $renderer,
         Router $router,
         Table $table,
         FlashService $flash
    ){
      $this->renderer = $renderer;
        $this->router = $router;
        $this->table = $table;
        $this->flash = $flash;
    }

    public function __invoke(Request $request)
    {
        $this->renderer->addGlobal('viewPath', $this->viewPath);
        $this->renderer->addGlobal('routePrefix', $this->routePrefix);
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

    /**
     * Affiche la liste des éléments
     * @param Request $request
     * @return string
     */
    public function index(Request $request): string
    {
        $params = $request->getQueryParams();
        $items = $this->table->findPaginated(12, $params['p'] ?? 1);

        return $this->renderer->render($this->viewPath . '/index', compact('items'));
    }

    /**
     * Edite un élément
     * @param Request $request
     * @return ResponseInterface|string
     */
    public function edit(Request $request)
    {
        $item = $this->table->find($request->getAttribute('id'));
        $errors= [];

        if ($request->getMethod() === 'POST') {
            $params = $this->getParams($request);
            $validator = $this->getValidator($request);
            if ($validator->isValid()) {
                $this->table->update($item->id, $params);
                $this->flash->success($this->messages['edit']);
                return $this->redirect($this->routePrefix . '.index');
            }
            $errors = $validator->getErrors();
            $params['id'] = $item->id;
            $item = $params;
        }
        

        return $this->renderer->render(
            $this->viewPath . '/edit',
            $this->formParams(compact('item', 'errors'))
        );
    }

    /**
     * Crée un nouvel élément
     * @param Request $request
     * @return ResponseInterface|string
     */
    public function create(Request $request)
    {

        $item= $this->getNewEntity();
        $errors= [];
        if($request->getMethod()=== 'POST'){
            $params = $this->getParams($request);
            $validator = $this->getValidator($request);
            if ($validator->isValid()) {
                $this->table->insert($params);
                $this->flash->success($this->messages['create']);
                return $this->redirect($this->routePrefix . '.index');
            }
            $item = $params;
            $errors = $validator->getErrors();
        }

        return $this->renderer->render(
            $this->viewPath . '/create',
            $this->formParams(compact('item', 'errors'))
        );
    }

    public function delete(Request $request)
    {
        $this->table->delete($request->getAttribute('id'));
        $this->flash->success('La propriété a bien été supprimée');
        return $this->redirect('properties.admin.index');
    }

    private function getParams(Request $request): array
    {
        return array_filter($request->getParsedBody(), function($key){
            return in_array($key, [
                'slug', 'title', 'name', 'description', 'created_at', 'price', 'area', 'rooms', 'carrez',
                'prefix_area', 'land_area', 'bedrooms', 'bathrooms', 'garages',
                'construction_year', 'ac', 'swimming_pool', 'lawn', 'barbecue',
                'microwave', 'television', 'dryer', 'outdoor_shower', 'washer',
                'gym', 'fridge', 'wifi', 'laundry', 'sauna', 'windows_curtains',
                'adress', 'zip_code', 'city', 'country', 'longitude', 'latitude'
            ]);
            // on doit mettre tout pour la base de données??
        }, ARRAY_FILTER_USE_KEY);
    }

    protected function getValidator(Request $request)
    {
        return new Validator($request->getParsedBody());
    }

    protected function getNewEntity()
    {
      return [];
    }
    
    /**
     * Permet de traiter les paramètres à envoyer à la vue
     *
     * @param $params
     * @return array
     */
    protected function formParams(array $params): array
    {
        return $params;
    }
}