<?php

namespace App\Faq\Actions;

use App\Faq\Table\FaqTable;
use Framework\Router;
use Framework\Actions\RouterAwareAction;
use Framework\Renderer\RendererInterface;

class FaqAction
{
    use RouterAwareAction;



    public function __construct(
        private RendererInterface $renderer,
        private Router $router,
        private FaqTable $faqTable
    ){}

    public function __invoke()
    {
        return $this->index();
    }

    public function index(): string
    {
        $faqs =$this->faqTable->findAll();
        return $this->renderer->render('@faq/index', [
            'faqs' => $faqs]);
    }
}