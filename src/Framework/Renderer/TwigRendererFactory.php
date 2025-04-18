<?php

namespace Framework\Renderer;

use Psr\Container\ContainerInterface;

class TwigRendererFactory
{
    public function __invoke(ContainerInterface $container): TwigRenderer 
    {
        $viewsPath = $container->get('views.path'); 
        $loader = new \Twig\Loader\FilesystemLoader($viewsPath);
        $twig = new \Twig\Environment($loader);

        if ($container->has('twig.extensions'))
        {
            foreach ($container->get('twig.extensions') as $extension)
            {
                $twig->addExtension($extension);
            }
        }

        return new TwigRenderer($loader, $twig);
    }
}