<?php
/*
 * Copyright (c) 2025 HivePHP OldVkDev
 *
 *  For the full copyright and license information, please view the LICENSE
 *   file that was distributed with this source code.
 *
 */

namespace App\Http\Controllers;

class AuthPageController extends Controller
{
    public function showLogin(): void
    {
       $sitName = $this->config->get('app.name');
       echo '<h1>' . $sitName . '</h1>';
    }
}