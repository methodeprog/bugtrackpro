<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $authHeader = $request->getHeaderLine('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return response()->setJSON(['message' => 'Token manquant'])->setStatusCode(401);
        }

        $token = str_replace('Bearer ', '', $authHeader);
        $key = getenv('JWT_SECRET');

        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            $request->user = $decoded;
        } catch (\Exception $e) {
            return response()->setJSON(['message' => 'Token invalide'])->setStatusCode(401);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
