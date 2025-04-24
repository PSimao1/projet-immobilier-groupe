<?php

namespace App\Contact;

use Framework\Module;

use Framework\Router;     


use App\Contact\Actions\ContactAction;
use Framework\Renderer\RendererInterface;


class ContactModule extends Module
{
    const DEFINITIONS = __DIR__ . '/config.php';
    const MIGRATIONS = __DIR__ . '/db/migrations';
    const SEEDS = __DIR__ . '/db/seeds';

    public function __construct(string $prefix, Router $router, RendererInterface $renderer)
    {

        $renderer->addPath('contact', __DIR__ . '/views');
        $router->get($prefix, ContactAction::class, 'contact.index');
    }
    
}