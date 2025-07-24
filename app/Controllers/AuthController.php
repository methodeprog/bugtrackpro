<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController extends ResourceController
{
    protected $modelName = UserModel::class;
    protected $format = 'json';

    public function login()
    {
        $input = $this->request->getJSON(true);

        if (empty($input['email']) || empty($input['password'])) {
            return $this->failValidationErrors('Email and password are required.');
        }

        $user = $this->model->where('email', $input['email'])->first();

        if (!$user) {
            return $this->failNotFound('User not found.');
        }

        if (!password_verify($input['password'], $user['password'])) {
            return $this->fail('Invalid credentials', 401);
        }

        $config = config('Jwt');

        $now = time();
        $payload = [
            'iat' => $now,
            'exp' => $now + $config->expireTime,
            'sub' => $user['id'],
            'email' => $user['email'],
            'role' => $user['role'],
        ];

        $token = JWT::encode($payload, $config->secretKey, 'HS256');

        return $this->respond(['token' => $token]);
    }

    public function logout()
    {
        // Comme JWT est stateless, logout est côté client (effacer token)
        return $this->respond(['message' => 'Logout handled client-side']);
    }
}
