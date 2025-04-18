<?php

namespace App\cart;

use Framework\Module;

use Framework\Router;     

use App\Cart\Actions\CartAction;
use Framework\Renderer\RendererInterface;


class CartModule extends Module
{
    const DEFINITIONS = __DIR__ . '/config.php';


    public function __construct(string $prefix, Router $router, RendererInterface $renderer)
    {

        $renderer->addPath('cart', __DIR__ . '/views');
        $router->get($prefix, CartAction::class, 'cart.index');
    }
    
}