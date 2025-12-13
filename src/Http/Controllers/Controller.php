<?php
/*
 * Copyright (c) 2025 HivePHP OldVkDev
 *
 *  For the full copyright and license information, please view the LICENSE
 *   file that was distributed with this source code.
 *
 */
declare(strict_types=1);

namespace App\Http\Controllers;

use HivePHP\Configs;
use HivePHP\Container;
use HivePHP\Services\TwigService;
use HivePHP\Services\LayoutResolver;
use HivePHP\Support\AssetManager;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class Controller
{
    protected Container $container;
    protected Configs $config;

    protected TwigService $twigFactory;

    protected AssetManager $assetManager;

    protected LayoutResolver $layoutResolver;


    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->config = $container->get(Configs::class);
        $this->twigFactory = $container->get(TwigService::class);
        $this->assetManager = $container->get(AssetManager::class);
        $this->layoutResolver = $container->get(LayoutResolver::class);
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    protected function render(string $template, array $params = []): void
    {
        if (!isset($params['layout'])) {
            $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $params['layout'] = $this->layoutResolver->resolve($path);
        }

        $params['siteName'] = $this->config->get('app.name');

        echo $this->twigFactory->get()->render($template, $params);
    }
}