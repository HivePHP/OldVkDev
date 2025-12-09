<?php
/*
 * Copyright (c) 2025 HivePHP OldVkDev
 *
 *  For the full copyright and license information, please view the LICENSE
 *   file that was distributed with this source code.
 *
 */

declare(strict_types=1);

namespace HivePHP\Support;

class AssetManager
{
    protected array $css = [];
    protected array $js = [];

    public function css(string $file): void
    {
        if ($file !== '' && preg_match('/^[a-zA-Z0-9_\-\/\.]+$/', $file)) {
            // Если уже есть / в начале, считаем это полным путем
            $this->css[] = str_starts_with($file, '/') ? $file : '/css/' . $file;
        }
    }

    public function js(string $file): void
    {
        if ($file !== '' && preg_match('/^[a-zA-Z0-9_\-\/\.]+$/', $file)) {
            $this->js[] = str_starts_with($file, '/') ? $file : '/js/' . $file;
        }
    }

    public function renderCss(): string
    {
        $html = "";
        foreach ($this->css as $file) {
            $html .= "<link rel=\"stylesheet\" href=\"{$file}\">\n";
        }
        return $html;
    }

    public function renderJs(): string
    {
        $html = "";
        foreach ($this->js as $file) {
            $html .= "<script src=\"{$file}\"></script>\n";
        }
        return $html;
    }
}
