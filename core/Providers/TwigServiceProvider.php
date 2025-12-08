<?php
/*
 * Copyright (c) 2025 HivePHP OldVkDev
 *
 *  For the full copyright and license information, please view the LICENSE
 *   file that was distributed with this source code.
 *
 */
declare(strict_types=1);

namespace HivePHP\Providers;

use HivePHP\Container;
use HivePHP\TwigFactory;
use HivePHP\Configs;
use HivePHP\AssetManager;

class TwigServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container):void
    {
        // Register AssetManager
        $container->set(AssetManager::class, fn() => new AssetManager());

        // Register TwigFactor
        $container->set(TwigFactory::class, function() use ($container) {

            /** @var Configs $configs */
            $configs = $container->get(Configs::class);
            $twigConfig = $configs->get('twig'); // берём twig конфиг
            $assetManager = $container->get(AssetManager::class);

            return new TwigFactory($twigConfig, $assetManager);
        });
    }

    public function boot(Container $container): void
    {
        /** @var TwigFactory $twigFactory */
        //$twigFactory = $container->get(TwigFactory::class);
        //$twig = $twigFactory->get();
    }
}