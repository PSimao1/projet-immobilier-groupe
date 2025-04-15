<?php

require '../vendor/autoload.php';


use Framework\Renderer\TwigRenderer;

$renderer = new TwigRenderer(dirname(__DIR__) . '/views');

$app = new \Framework\App([\App\Blog\BlogModule::class], ['renderer'=> $renderer]);

$response = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());

\Http\Response\send($response);