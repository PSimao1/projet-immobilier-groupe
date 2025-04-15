<?php

namespace Framework\Renderer;

class PHPRenderer implements RendererInterface
{
    const DEFAULT_NAMESPACE = '__MAIN';

    private $paths = [];

    /**
     * Variables globales disponibles dans toutes les vues (ex: utilisateur connecté, titre du site...)
     * @var array
     */
    private $globals = [];

    public function __construct(?string $defaultPath = null)
    {
        if (!is_null($defaultPath)) {
            $this->addPath($defaultPath);
        }
        
    }

    /**
     * Permet d’ajouter un chemin pour charger les vues
     * @param string $namespace Le nom du namespace ou bien le chemin si $path est null
     * @param null|string $path Le chemin des vues
     */
    public function addPath(string $namespace, ?string $path = null): void
    {
        if (is_null($path)) {
            $this->paths[self::DEFAULT_NAMESPACE] = $namespace;
        } else {
            $this->paths[$namespace] = $path;
        }
        
    }

    /**
     * Méthode principale pour afficher une vue
     * @param string $view Le nom de la vue (ex: '@blog/index' ou 'home')
     * @param array $params Les variables à passer à la vue
     * @return string Le contenu HTML rendu
     */
    public function render(string $view, array $params = []): string
    {
        if ($this->hasNamespace($view)) {
            $path = $this->replaceNamespace($view) . '.php';
           
        } else {
            $path = $this->paths[self::DEFAULT_NAMESPACE] . DIRECTORY_SEPARATOR . $view . '.php';
        }

        ob_start();

        $renderer = $this;

        extract($this->globals);

        extract($params);

        require($path);

        return ob_get_clean();
    }

    /**
     * Ajoute une variable globale accessible dans toutes les vues
     * @param string $key Nom de la variable
     * @param mixed $value Valeur de la variable
     */
    public function addGlobal(string $key, $value): void
    {
        $this->globals[$key] = $value;
    }

    private function hasNamespace(string $view): bool
    {
        return $view[0] === '@';
    }

    private function getNamespace(string $view): string
    {
        return substr($view, 1, strpos($view, '/') - 1);
    }

    private function replaceNamespace(string $view): string
    {
        $namespace = $this->getNamespace($view);
        return str_replace('@' . $namespace, $this->paths[$namespace], $view);
    }
}