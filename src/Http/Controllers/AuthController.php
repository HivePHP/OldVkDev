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

use JetBrains\PhpStorm\NoReturn;

class AuthController
{
    #[NoReturn]
    public function register(): void
    {
        $data = json_decode(file_get_contents("php://input"), true);


        $response = [
            "status" => 'ok',
            "uid" => $data
        ];
        die(json_encode($response));
    }

    public function login(): void
    {

    }
}