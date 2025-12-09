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

class AuthPageController extends Controller
{
    public function showLogin(): void
    {
       $this->render('auth/login.twig', [
           'title' => 'Авторизация',
       ]);
    }

    public function showRegister(): void
    {
        $this->render('auth/register.twig', [
            'title' => 'Регистрация',
        ]);
    }
}