<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    protected $allowedRoles = [];

    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $userRole = $session->get('role');

        $this->allowedRoles = $arguments ?? [];

        if (!in_array($userRole, $this->allowedRoles)) {
            // Redirection si accès refusé
            return redirect()->to('/login')->with('error', 'Accès refusé.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Rien à faire après
    }
}
