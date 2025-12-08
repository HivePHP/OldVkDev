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

class Configs
{
    private array $configs = [];

    public function __construct(string $path)
    {
        foreach (glob($path . '/*.php') ?: [] as $file) {
            $name = basename($file, '.php');
            $this->configs[$name] = require $file;
        }
    }

    public function get(string $key, mixed $default = null): mixed
    {
        $parts = explode('.', $key);
        $value = $this->configs;

        foreach ($parts as $part) {
            if (!array_key_exists($part, $value)) {
                return $default;
            }
            $value = $value[$part];
        }

        return $value;
    }

    public function all(): array
    {
        return $this->configs;
    }
}
