<?php

use function \DI\get;

use App\Faq\FaqModule;
use function DI\autowire;




return [
   'faq.prefix' => '/faq',
    FaqModule::class => autowire()->constructorParameter('prefix', get('faq.prefix'))
];