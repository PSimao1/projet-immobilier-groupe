<?php
require '../vendor/autoload.php';

$app = new \Framework\App();
$app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());