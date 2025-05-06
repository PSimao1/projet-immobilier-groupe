<?php

namespace Framework\Renderer;

use Psr\Container\ContainerInterface;
use Twig\Extension\DebugExtension;

class TwigRendererFactory
{
    public function __invoke(ContainerInterface $container): TwigRenderer 
    {
        $viewsPath = $container->get('views.path'); 
        $loader = new \Twig\Loader\FilesystemLoader($viewsPath);
        $twig = new \Twig\Environment($loader, ['debug' => true]);
        $twig->addExtension(new DebugExtension());

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