<?php
/*
 * Copyright (c) 2025 HivePHP OldVkDev
 *
 *  For the full copyright and license information, please view the LICENSE
 *   file that was distributed with this source code.
 *
 */


namespace App\Http\Controllers;

use HivePHP\Configs;
use HivePHP\Container;

class Controller
{
    protected Container $container;
    protected Configs $config;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->config = $container->get(Configs::class);
    }
}