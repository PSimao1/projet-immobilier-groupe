<?php



use function \DI\get;
use function DI\autowire;
use App\Properties\PropertiesModule;

return [
    'properties.prefix' => '/properties',
    PropertiesModule::class => autowire()->constructorParameter('prefix', get('properties.prefix'))
];