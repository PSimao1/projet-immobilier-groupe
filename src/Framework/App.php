<?php
namespace Framework;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class App 
{
    private $modules = [];
    
    private $router;

    public function __construct(array $modules = [], array $dependencies = [])
    {
        $this->router = new Router();
        if (array_key_exists('renderer', $dependencies)) {
            $dependencies['renderer']->addGlobal('router', $this->router);
        }
        
        foreach ($modules as $module) {
            $this->modules[] = new $module($this->router, $dependencies['renderer']);
        }

    }

    public function run(ServerRequestInterface $request): ResponseInterface
    {
        $uri= $request->getUri()->getPath();

        if(!empty ($uri) && $uri[-1] === "/") {
            return(new Response())
                ->withStatus(301)
                ->withHeader('Location', substr($uri, 0, -1));
        }
        $route = $this->router->match($request);
        $response = call_user_func_array($route->getCallback(), [$request]);

        if($uri === '/blog') {
            return new Response(200, [], $response);

        }elseif ($response instanceof ResponseInterface) {
            
        }

        
        if($uri === '/about') {
            return new Response(200, [],'<h1>Bienvenue About</h1>');
        }

        
        if($uri === '/account') {
            return new Response(200, [],'<h1>Bienvenue sur le Account</h1>');
        }

        
        if($uri === '/cart') {
            return new Response(200, [],'<h1>Bienvenue sur le Cart</h1>');
        }

        if($uri === '/contact') {
            return new Response(200, [],'<h1>Bienvenue sur les Contacts</h1>');
        }

        if($uri === '/faq') {
            return new Response(200, [],'<h1>Bienvenue sur la FAQ</h1>');
        }

        if($uri === '/home') {
            return new Response(200, [],'<h1>Bienvenue sur la Page d\'acceuil</h1>');
        }

        if($uri === '/project') {
            return new Response(200, [],'<h1>Bienvenue sur les Projets</h1>');
        }

        if($uri === '/properties') {
            return new Response(200, [],'<h1>Bienvenue sur les Propriétés</h1>');
        }
        return new Response(404, [], '<h1>Erreur 404</h1>');
    }


}