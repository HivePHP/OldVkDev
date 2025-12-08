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
use HivePHP\Http\Router;

class RouteServiceProvider implements ServiceProviderInterface
{
    protected Router $router;

    public function register(Container $container): void
    {
        $this->router = new Router($container);
        $container->set(Router::class, fn() => $this->router);

    }

    public function boot(Container $container): void
    {
        $router = $container->get(Router::class);
        (function ($router)
        {
            require ROOT . '/routes/web.php';
        })($router);

        $router->dispatch();
    }
}