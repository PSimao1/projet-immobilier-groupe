<?php


use function \DI\get;
use function DI\autowire;
use App\Project\ProjectModule;

return [
    'project.prefix' => '/project',
    ProjectModule::class => autowire()->constructorParameter('prefix', get('project.prefix'))
];