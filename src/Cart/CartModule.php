<?php

namespace App\Cart;


use Framework\Renderer\RendererInterface;
use Framework\Router;     
use Psr\Http\Message\ServerRequestInterface as Request; 


class CartModule
{

    private $renderer;
    

    public function __construct(Router $router, RendererInterface $renderer)
    {

        $this->renderer = $renderer;

        $this->renderer->addPath('cart', __DIR__ . '/views');

        $router->get('/cart', [$this, 'index'], 'cart.index');
    }
    
    /**
     * Méthode pour afficher la page d'index du Cart (liste des articles)
     * 
     * @param Request $request - La requête HTTP
     * @return string - Le HTML généré
     */
    public function index(): string
    {
        
        return $this->renderer->render('@cart/index');
    }
}