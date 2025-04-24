<?php

namespace Framework\Renderer;

class TwigRenderer implements RendererInterface
{
    private $twig;
    private $loader;
    
    /**
     * __construct
     *
     * @param  mixed $loader
     * @param  mixed $twig
     * @return void
     */
    public function __construct(\Twig\Loader\FilesystemLoader $loader, \Twig\Environment $twig)
    {
        $this->loader = $loader;
        $this->twig = $twig;
    }
    
    /**
     * addPath
     *
     * @param  mixed $namespace
     * @param  mixed $path
     * @return void
     */
    public function addPath(string $namespace, ?string $path = null): void 
    {
        $this->loader->addPath($path, $namespace);
    }
    
    /**
     * render
     *
     * @param  mixed $view
     * @param  mixed $params
     * @return string
     */
    public function render(string $view, array $params = []): string 
    {
        return $this->twig->render($view . '.twig', $params);
    }
    
    /**
     * addGlobal
     *
     * @param  mixed $key
     * @param  mixed $value
     * @return void
     */
    public function addGlobal(string $key, $value): void 
    {
        $this->twig->addGlobal($key, $value);
    }
}