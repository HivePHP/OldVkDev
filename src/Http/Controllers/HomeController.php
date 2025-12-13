<?php
/*
 * Copyright (c) 2025 HivePHP OldVkDev
 *
 *  For the full copyright and license information, please view the LICENSE
 *   file that was distributed with this source code.
 *
 */


namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function showLogin(): void
    {
        $this->assetManager->css('home/login.css');
        $this->assetManager->js('home/login.js');

        $this->render('home/login.twig', [
            'title' => 'Авторизация',
        ]);
    }

    public function showRegister(): void
    {
        $this->assetManager->css('home/register.css');
        $this->assetManager->js('home/register.js');

        $this->render('home/register.twig', [
            'title' => 'Регистрация',
        ]);
    }
}