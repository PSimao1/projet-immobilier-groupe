<?php

namespace Tests;

use Framework\Renderer\RendererInterface;
use PHPUnit\Framework\TestCase;
use Framework\Renderer\TwigRenderer;

class RendererTest extends TestCase 
{
    private RendererInterface $renderer;
    

    public function setUp(): void
    {
        $this->renderer = new TwigRenderer(__DIR__ . '/views');
    }

    public function testRenderTheRightPath()
    {
        $this->renderer->addPath('blog', __DIR__ . '/views');

        $content = $this->renderer->render('@blog/demo');

        $this->assertEquals('Salut les copains', $content);
    }
}