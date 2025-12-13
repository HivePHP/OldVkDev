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

use HivePHP\Configs;
use HivePHP\Container;
use HivePHP\Services\TwigService;
use HivePHP\Support\AssetManager;

class TwigServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container):void
    {
        // Register AssetManager
        $container->set(AssetManager::class, fn() => new AssetManager());

        // Register TwigFactor
        $container->set(TwigService::class, function() use ($container) {

            /** @var Configs $configs */
            $configs = $container->get(Configs::class);
            $twigConfig = $configs->get('twig'); // берём twig конфиг
            $assetManager = $container->get(AssetManager::class);

            return new TwigService($twigConfig, $assetManager);
        });
    }

    public function boot(Container $container): void
    {
    }
}