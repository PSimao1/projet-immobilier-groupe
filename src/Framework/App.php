<?php
namespace Framework;

use GuzzleHttp\Psr7\Response;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class App 
{

    private $container;

    private $modules = [];
    


    public function __construct(ContainerInterface $container, array $modules = [])
    {
        $this->container = $container;

        foreach ($modules as $module) {
            $this->modules[] = $container->get($module);
        }

    }

    public function run(ServerRequestInterface $request): ResponseInterface
    {
        $uri = $request->getUri()->getPath();
        $parseBody= $request->getParsedBody();

        if(array_key_exists('_method', $parseBody) &&
            in_array($parseBody['_method'], ['DELETE', 'PUT'])
        ){
            $request = $request->withMethod($parseBody['_method']);
        }
        if ($uri === "/index.php") {
            return (new Response())
                ->withStatus(301)
                ->withHeader('Location', '/');
        }
        $router = $this->container->get(Router::class);
        $route = $router->match($request);

        if (is_null($route)) {
            return new Response(404, [], '<h1>Erreur 404</h1>');
        }

        $params = $route->getParams();
        $request = array_reduce(array_keys($params), function ($request, $key) use ($params) {
            return $request->withAttribute($key, $params[$key]);
        }, $request);

        $callback = $route->getCallback();
        
        if (is_string($callback)) {
            $callback = $this->container->get($callback);
        }

        $response = call_user_func_array( $callback, [$request]);

        if (is_string($response)) {
            return new Response(200, [], $response);
        } 
        elseif ($response instanceof ResponseInterface) {
            return $response;
        } 
        else {
            throw new \Exception('The response is not a string or an instance of ResponseInterface');
        }
    }
    /**
     * @return ContainerInterface
     */
    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }
}
