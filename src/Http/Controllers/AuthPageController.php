<?php
/*
 * Copyright (c) 2025 HivePHP OldVkDev
 *
 *  For the full copyright and license information, please view the LICENSE
 *   file that was distributed with this source code.
 *
 */
declare(strict_types=1);

namespace App\Http\Controllers;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class AuthPageController extends Controller
{
    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function showLogin(): void
    {
       $sitName = $this->config->get('app.name');

       $this->render('auth/login.twig', [
           'sitName' => $sitName,
       ]);
    }
}