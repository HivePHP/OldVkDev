<?php
/*
 * Copyright (c) 2025 HivePHP OldVkDev
 *
 *  For the full copyright and license information, please view the LICENSE
 *   file that was distributed with this source code.
 *
 */

namespace HivePHP\Services;

use HivePHP\Support\AssetManager;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

class TwigService
{
    private Environment $twig;

    public function __construct(array $config, AssetManager $assets)
    {
        $views = $config['views_path'] ?? ROOT . '/views';
        $cache = $config['cache_path'] ?? ROOT . '/storage/cache/twig';
        $debug = $config['debug'] ?? false;

        $loader = new FilesystemLoader($views);

        $this->twig = new Environment($loader, [
            'debug' => $debug,
            'cache' => $debug ? false : $cache,
            'auto_reload' => true,
        ]);

        // Twig функции
        $this->twig->addFunction(new TwigFunction('css', fn() => $assets->renderCss(), ['is_safe' => ['html']]));
        $this->twig->addFunction(new TwigFunction('js', fn() => $assets->renderJs(), ['is_safe' => ['html']]));
    }

    public function get(): Environment
    {
        return $this->twig;
    }
}
