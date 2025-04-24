<?php

namespace App\account;

use Framework\Module;

use Framework\Router;     
use App\Account\Actions\AccountAction;
use Framework\Renderer\RendererInterface;


class AccountModule extends Module
{
    const DEFINITIONS = __DIR__ . '/config.php';
    const MIGRATIONS = __DIR__ . '/db/migrations';
    const SEEDS = __DIR__ . '/db/seeds';
    
    /**
     * __construct
     *
     * @param  mixed $prefix
     * @param  mixed $router
     * @param  mixed $renderer
     * @return void
     */
    public function __construct(string $prefix, Router $router, RendererInterface $renderer)
    {

        $renderer->addPath('account', __DIR__ . '/views');
        $router->get($prefix, AccountAction::class, 'account.index');
    }
    
}