<?php
/*
 * Copyright (c) 2025 HivePHP OldVkDev
 *
 *  For the full copyright and license information, please view the LICENSE
 *   file that was distributed with this source code.
 *
 */

declare(strict_types=1);

namespace HivePHP;

class Bootstrap
{
    protected array $providers = [
        \App\Providers\AppServiceProvider::class,

        \HivePHP\Providers\ConfigServiceProvider::class,
        \HivePHP\Providers\RouteServiceProvider::class,
        \HivePHP\Providers\TwigServiceProvider::class,
        \HivePHP\Providers\LayoutServiceProvider::class,
    ];

    protected array $instances = [];

    public function __construct(protected Container $container){}

    public function run(): void
    {
        $this->registerProviders();
        $this->bootProviders();
    }

    protected function registerProviders(): void
    {
        foreach ($this->providers as $providerClass) {
            $provider = new $providerClass($this->container);
            $provider->register($this->container);
            $this->instances[] = $provider;
        }
    }

    protected function bootProviders(): void
    {
        foreach ($this->instances as $provider) {
            if(method_exists($provider, 'boot')){
                $provider->boot($this->container);
            }
        }
    }
}