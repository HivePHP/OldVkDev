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
use HivePHP\Services\LayoutResolver;

class LayoutServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container): void
    {
        $container->set(LayoutResolver::class, fn() => new LayoutResolver());
    }

    public function boot(Container $container): void {}
}
