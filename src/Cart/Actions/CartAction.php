<?php

namespace App\Cart\Actions;


use Framework\Router;
use GuzzleHttp\Psr7\Request;
use App\Cart\Table\CartTable;
use Framework\Renderer\RendererInterface;

class CartAction
{
    public function __construct(private RendererInterface $renderer, private Router $router, private CartTable $cartTable)
    {
        $this->renderer = $renderer;
        $this->router = $router;
        $this->cartTable = $cartTable;
    }

    public function __invoke(Request $request)
    {
        return $this->index();
    }

    public function index(): string
    {
        $cart = $this->cartTable->findAllWithProperties();
        return $this->renderer->render('@cart/index', [
            'cart' => $cart
        ]);
    }
}