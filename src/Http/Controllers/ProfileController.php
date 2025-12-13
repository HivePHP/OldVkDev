<?php
/*
 * Copyright (c) 2025 HivePHP OldVkDev
 *
 *  For the full copyright and license information, please view the LICENSE
 *   file that was distributed with this source code.
 *
 */


namespace App\Http\Controllers;

class ProfileController extends Controller
{
    public function show(int $id)
    {
        $this->render('profile/profile.twig', [
            'title' => 'Авторизация',
            'user_id' => $id,
        ]);
    }
}