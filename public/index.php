<?php

require dirname(__DIR__) . '../vendor/autoload.php';

use DI\ContainerBuilder;
use GuzzleHttp\Psr7\ServerRequest;

$modules = [
    \App\Blog\BlogModule::class, 
    \App\Faq\FaqModule::class, 
    \App\About\AboutModule::class,
    \App\Contact\ContactModule::class,
    \App\Cart\CartModule::class,
    \App\Home\HomeModule::class,
    \App\Project\ProjectModule::class,
    \App\Properties\PropertiesModule::class,
    \App\Account\AccountModule::class
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
if (php_sapi_name() !== "cli")
{
    $response = $app->run(ServerRequest::fromGlobals());
    \Http\Response\send($response);
}