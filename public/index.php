<?php

require '../vendor/autoload.php';


use Framework\Renderer\TwigRenderer;

$renderer = new TwigRenderer(dirname(__DIR__) . '/views');

$app = new \Framework\App([\App\Blog\BlogModule::class, 
\App\Faq\FaqModule::class, 
\App\About\AboutModule::class,
\App\Account\AccountModule::class,
\App\Contact\ContactModule::class,
\App\Cart\CartModule::class,
\App\Home\HomeModule::class,
\App\Project\ProjectModule::class,
\App\Properties\PropertiesModule::class,
 ], ['renderer'=> $renderer]);

$response = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());

\Http\Response\send($response);