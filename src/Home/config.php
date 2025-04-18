<?php

use App\Home\HomeModule;

use function DI\autowire;
use function \DI\get;

return [
    'home.prefix' => '/',
    HomeModule::class => autowire()->constructorParameter('prefix', get('home.prefix'))
];