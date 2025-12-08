<?php
/*
 * Copyright (c) 2025 HivePHP OldVkDev
 *
 *  For the full copyright and license information, please view the LICENSE
 *   file that was distributed with this source code.
 *
 */


namespace HivePHP;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

class TwigFactory
{
    private ?Environment $twig = null;


    public function __construct(array $config, $assetManager)
    {
        if ($this->twig !== null) {
            return;
        }

        $views = $config['views_path'] ?? ROOT . '/views';
        $cache = $config['cache_path'] ?? ROOT . '/storage/cache/twig';

        $loader = new FilesystemLoader($views);

        $this->twig = new Environment($loader, [
            'cache'       => $cache,
            'debug'       => $config['debug'] ?? false,
            'auto_reload' => $config['auto_reload'] ?? true,
        ]);

        // CSS
        $this->twig->addFunction(new TwigFunction(
            'css',
            fn() => $assetManager->renderCss(),
            ['is_safe' => ['html']]
        ));

        // JS
        $this->twig->addFunction(new TwigFunction(
            'js',
            fn() => $assetManager->renderJs(),
            ['is_safe' => ['html']]
        ));
    }

    public function get(): Environment
    {
        if (!$this->twig) {
            throw new \RuntimeException("Twig is not initialized. Call TwigFactory::create() first.");
        }

        return $this->twig;
    }
}
