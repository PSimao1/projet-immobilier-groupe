<?php

use function \DI\get;
use App\Cart\CartModule;
use function DI\autowire;

return [
   'cart.prefix' => '/cart',
    CartModule::class => autowire()->constructorParameter('prefix', get('cart.prefix'))
];