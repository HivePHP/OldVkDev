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

use HivePHP\AssetManager;
use HivePHP\Configs;
use HivePHP\Container;
use HivePHP\TwigFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class Controller
{
    protected Container $container;
    protected Configs $config;

    protected TwigFactory $twigFactory;

    protected AssetManager $assetManager;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->config = $container->get(Configs::class);
        $this->twigFactory = $container->get(TwigFactory::class);
        $this->assetManager = $container->get(AssetManager::class);
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    protected function render(string $template, array $params = []):void
    {
        if (!isset($params['layout'])) {
            $params['layout'] = 'layout.twig';
        }

        echo $this->twigFactory->get()->render($template, $params);
    }
}