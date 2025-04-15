<?php

namespace App\Contact;


use Framework\Renderer\RendererInterface;
use Framework\Router;     
use Psr\Http\Message\ServerRequestInterface as Request; 


class ContactModule
{

    private $renderer;
    

    public function __construct(Router $router, RendererInterface $renderer)
    {

        $this->renderer = $renderer;

        $this->renderer->addPath('contact', __DIR__ . '/views');

        $router->get('/contact', [$this, 'index'], 'contact.index');
    }
    
    /**
     * Méthode pour afficher la page d'index du contact (liste des articles)
     * 
     * @param Request $request - La requête HTTP
     * @return string - Le HTML généré
     */
    public function index(): string
    {
        
        return $this->renderer->render('@contact/index');
    }
}