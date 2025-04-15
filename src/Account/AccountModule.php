<?php

namespace App\Account;


use Framework\Renderer\RendererInterface;
use Framework\Router;     
use Psr\Http\Message\ServerRequestInterface as Request; 


class AccountModule
{

    private $renderer;
    

    public function __construct(Router $router, RendererInterface $renderer)
    {

        $this->renderer = $renderer;

        $this->renderer->addPath('account', __DIR__ . '/views');

        $router->get('/account', [$this, 'index'], 'account.index');
    }
    
    /**
     * Méthode pour afficher la page d'index du account (liste des articles)
     * 
     * @param Request $request - La requête HTTP
     * @return string - Le HTML généré
     */
    public function index(): string
    {
        
        return $this->renderer->render('@account/index');
    }
}