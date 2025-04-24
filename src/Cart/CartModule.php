<?php

namespace App\cart;

use Framework\Module;
use Framework\Router;     
use App\Cart\Actions\CartAction;
use Framework\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
class CartModule extends Module
{
    const DEFINITIONS = __DIR__ . '/config.php';
    const MIGRATIONS = __DIR__ . '/db/migrations';
    const SEEDS = __DIR__ . '/db/seeds';

    public function __construct(string $prefix, Router $router, RendererInterface $renderer)
    {
        $renderer->addPath('cart', __DIR__ . '/views');
        $router->get($prefix, CartAction::class, 'cart.index');
        $router->get($prefix . '/{slug}', CartAction::class, 'cart.show');
    }
}