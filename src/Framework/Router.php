<?php
namespace Framework;

use Framework\Router\Route; // Notre propre classe Route
use Psr\Http\Message\ServerRequestInterface; // Interface standard PSR-7 pour une requête HTTP
use Laminas\Router\Http\TreeRouteStack; // Routeur fourni par Laminas
use Laminas\Router\Http\Literal; // Type de route "fixe"
use Laminas\Router\Http\Segment; // Type de route "avec paramètres"
use Laminas\Http\PhpEnvironment\Request as LaminasRequest; // Représente une requête HTTP pour Laminas
use Laminas\Router\RouteMatch; // Résultat d'une tentative de correspondance avec une route

class Router
{
    private TreeRouteStack $router;
    private array $routes = [];

    public function __construct()
    {
        $this->router = new TreeRouteStack();
    }

    /**
     * @param string $path
     * @param callable $callable
     * @param string $name
     */

    public function get(string $path, callable $callable, string $name):void
    {
        $this->routes[$name] = [
            'path' => $path,
            'callback' => $callable,
            'method' => 'GET',
        ];

        if(strpos($path, '{') !== false) {
            $laminasPath = preg_replace('/{([^}]+)}/', ':$1', $path);
            $this->router->addRoute($name, [
                'type' => Segment::class,
                'options' => [
                    'route' => $laminasPath,
                    'defaults' => [
                        'method' => 'GET',
                    ],
                ]
            ]);
        }
        else{
            $this->router->addRoute($name, [
                'type' => Literal::class,
                'options' => [
                    'route' => $path,
                    'defaults' => [
                        'method' => 'GET',
                    ],
                ]
            ]);
        };
    }

    public function match(ServerRequestInterface $request): ?Route
    {
        $laminasRequest = new LaminasRequest();
        $laminasRequest->setUri($request->getUri()->getPath());
        $laminasRequest->setMethod($request->getMethod());

        $result = $this->router->match($laminasRequest);

        if ($result instanceof RouteMatch) {
            $routeName = $result->getMatchedRouteName();
            $callback = $this->routes[$routeName]['callback'] ?? null;

            if (!$callback) {
                return null;
            }

            $params = $result->getParams();

            unset($params['controller'], $params['action'], $params['method']);

            return new Route(
                $routeName,
                $callback,
                $params
            );
        }
        return null;
    }

    public function generateUri($name, array $params = []): ?string
    {
        try {
            return $this->router->assemble($params, [ 'name' => $name ]);
        } catch (\Exception $e) {
            if(!isset($this->routes[$name])) {
                return null;
            }
            $path = $this->routes[$name]['path'];
            foreach ($params as $paramsName => $paramsValue) {
                $path = str_replace("{{ $paramsName }}", $paramsValue, $path);
            }
            return $path;
        }
    }
}