<?php

use function \DI\get;

use App\About\AboutModule;
use function DI\autowire;


return [
   'about.prefix' => '/about',
    AboutModule::class => autowire()->constructorParameter('prefix', get('about.prefix'))
];