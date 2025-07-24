<?php

namespace App\Modules\AuthModule\Controllers;

use App\Controllers\BaseController;
use App\Modules\AuthModule\Models\UserModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController extends BaseController
{
    protected $userModel;
    protected $key;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->key = getenv('JWT_SECRET') ?: 'super_secret_key';
    }

    // Formulaire de connexion (GET)
    public function loginForm()
    {
        return view('App\Modules\AuthModule\Views\login');
    }

   // AuthController.php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Modules\AuthModule\Models\UserModel;

public function login()
{
    helper(['cookie', 'url']);

    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    $userModel = new UserModel();
    $user = $userModel->where('email', $email)->first();

    if (!$user || !password_verify($password, $user['password'])) {
        return redirect()->back()->withInput()->with('error', 'Identifiants incorrects');
    }

    // Génération du JWT
    $issuedAt   = time();
    $expiration = $issuedAt + 3600; // 1 heure
    $payload = [
        'iat'  => $issuedAt,
        'exp'  => $expiration,
        'data' => [
            'id'    => $user['id'],
            'email' => $user['email'],
            'name'  => $user['name'],
        ]
    ];

    $jwt = JWT::encode($payload, getenv('JWT_SECRET'), 'HS256');

    // Stockage dans un cookie sécurisé
    set_cookie([
        'name'     => 'token',
        'value'    => $jwt,
        'expire'   => 3600, // 1 heure
        'httponly' => true, // Inaccessible via JS
        'secure'   => true, // ⚠️ En HTTPS seulement // secure => true nécessite un site en HTTPS
        'samesite' => 'Strict', // empêche les requêtes externes de réutiliser le cookie
        'path'     => '/',
    ]);

    // Redirection vers le tableau de bord
    return redirect()->to('/dashboard');
}


    // Formulaire d'inscription (GET)
    public function registrationForm()
    {
        return view('App\Modules\AuthModule\Views\register');
    }

    // Traitement de l'inscription (POST)
    public function registration()
    {
        $data = $this->request->getPost();

        $rules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->save([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
        ]);

        return redirect()->to('/login')->with('success', 'Inscription réussie. Connectez-vous.');
    }

    public function logout()
{
    helper('cookie');
    delete_cookie('token');
    return redirect()->to('/auth/login')->with('success', 'Déconnecté avec succès.');
}

}
