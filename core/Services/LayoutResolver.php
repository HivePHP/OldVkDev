<?php
/*
 * Copyright (c) 2025 HivePHP OldVkDev
 *
 *  For the full copyright and license information, please view the LICENSE
 *   file that was distributed with this source code.
 *
 */

declare(strict_types=1);

namespace HivePHP\Services;

class LayoutResolver
{
    private array $authRoutes = [
        '/reg',
    ];

    public function resolve(string $currentPath): string
    {
        // Точное совпадение с главной страницей
        if ($currentPath === '/') {
            return 'layouts/main_home.twig';
        }

        // Проверка остальных маршрутов
        foreach ($this->authRoutes as $route) {
            if ($currentPath === $route || str_starts_with($currentPath, $route.'/')) {
                return 'layouts/main_home.twig';
            }
        }

        return 'layouts/main.twig';
    }
}
