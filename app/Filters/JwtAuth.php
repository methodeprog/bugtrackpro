<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $header = $request->getHeaderLine('Authorization');

        if (!$header || !preg_match('/Bearer\s(\S+)/', $header, $matches)) {
            return service('response')->setStatusCode(401)->setJSON(['error' => 'Token missing']);
        }

        $token = $matches[1];
        $config = config('Jwt');

        try {
            $decoded = JWT::decode($token, new Key($config->secretKey, 'HS256'));
            // Stocker les infos utilisateur dans la request pour la suite
            $request->user = $decoded;
        } catch (\Exception $e) {
            return service('response')->setStatusCode(401)->setJSON(['error' => 'Token invalide']);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Rien à faire
    }
}
