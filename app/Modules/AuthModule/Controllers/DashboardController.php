<?php

namespace App\Modules\AuthModule\Controllers;

use App\Controllers\BaseController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class DashboardController extends BaseController
{
    public function index()
    {
        $token = $this->request->getCookie('token');
        if (!$token) {
            return redirect()->to('/auth/login');
        }

        try {
            $decoded = JWT::decode($token, new Key(getenv('JWT_SECRET'), 'HS256'));
        } catch (\Exception $e) {
            return redirect()->to('/auth/login')->with('error', 'Session expirée');
        }

        return view('AuthModule\Views\dashboard', [
            'user' => $decoded->data ?? null
        ]);
    }
}
