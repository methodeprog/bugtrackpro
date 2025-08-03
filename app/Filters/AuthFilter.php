<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;


class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = Services::session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('auth/login')->with('error', 'Veuillez vous connecter pour accéder à cette page.');
        }

        // sinon, continuer
        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // rien après
    }
}
