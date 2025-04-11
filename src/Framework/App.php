<?php
namespace Framework;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class App 
{
    public function run(ServerRequestInterface $request): ResponseInterface
    {
        $uri= $request->getUri()->getPath();

        if(!empty ($uri) && $uri[-1] === "/") {
            return(new Response())
                ->withStatus(301)
                ->withHeader('Location', substr($uri, 0, -1));
        }
        
        if($uri === '/blog') {
            return new Response(200, [],'<h1>Bienvenue sur le blog</h1>');
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