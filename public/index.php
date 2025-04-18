<?php

require '../vendor/autoload.php';

use DI\ContainerBuilder;

$modules = [
    \App\Blog\BlogModule::class, 
    // \App\Faq\FaqModule::class, 
    // \App\About\AboutModule::class,
    // \App\Account\AccountModule::class,
    // \App\Contact\ContactModule::class,
    // \App\Cart\CartModule::class,
       \App\Home\HomeModule::class,
    // \App\Project\ProjectModule::class,
    // \App\Properties\PropertiesModule::class
];

$builder = new ContainerBuilder();
$builder->addDefinitions(dirname(__DIR__) . '/config/config.php');
foreach($modules as $module) {
    if($module::DEFINITIONS) {
        $builder->addDefinitions($module::DEFINITIONS);
    }
}
$container = $builder->build();

$app = new \Framework\App($container, $modules);
$response = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());
\Http\Response\send($response);