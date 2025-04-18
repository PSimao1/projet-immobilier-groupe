<?php

use function \DI\get;

use function DI\autowire;
use App\Contact\ContactModule;



return [
   'contact.prefix' => '/contact',
    ContactModule::class => autowire()->constructorParameter('prefix', get('contact.prefix'))
];