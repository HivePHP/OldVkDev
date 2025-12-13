<?php
/*
 * Copyright (c) 2025 HivePHP OldVkDev
 *
 *  For the full copyright and license information, please view the LICENSE
 *   file that was distributed with this source code.
 *
 */
declare(strict_types=1);

namespace App\Providers;

use HivePHP\Container;
use HivePHP\Providers\ServiceProviderInterface;
use HivePHP\Services\TwigService;
use HivePHP\Support\AssetManager;

class AppServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container): void
    {
        // Здесь можно регистрировать сервисы приложения, если нужно
    }

    public function boot(Container $container): void
    {
        $assets = $container->get(AssetManager::class);
        $twig = $container->get(TwigService::class);

        /* Глобальный вывод в шаблоны*/
        /*$twig->addGlobal('site', [
            '{}}' => Configs::get('app.site_name'),
        ]);*/

        // Global Css
        $assets->css('main.css');
        $assets->css('components/button.css');
        $assets->css('components/variables.css');
        $assets->css('components/sidebar.css');

        // Global Js
    }
}