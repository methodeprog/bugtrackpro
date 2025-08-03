<?php

namespace App\Modules\AuthModule\Controllers;

use App\Controllers\BaseController;
use App\Modules\AuthModule\Models\UserModel;
use CodeIgniter\Email\Email;

class AuthController extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = session();
    }

    // Affiche le formulaire de connexion
    public function loginForm()
    {
        return view('AuthModule\login');
    }


// Traite la connexion
public function login()
{
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    $user = $this->userModel->where('email', $email)->first();

    if (!$user || !password_verify($password, $user['password'])) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Email ou mot de passe incorrect.');
    }

    // Exemple de vérification de confirmation de l'email (à activer si tu implémentes cette colonne)
    // if (!$user['is_verified']) {
    //     return redirect()->back()->withInput()->with('error', 'Veuillez vérifier votre adresse email.');
    // }

    // Enregistre les infos de l'utilisateur dans la session
    $this->session->set([
        'user_id'    => $user['id'],
        'user_username'  => $user['username'],
        'user_email' => $user['email'],
        'isLoggedIn' => true,
    ]);

    return redirect()->to('/dashboard');
}


    // Affiche le formulaire d'inscription
    public function registrationForm()
    {
        return view('App\Modules\AuthModule\Views\register');
    }

    public function registration()
{
    $data = $this->request->getPost();

    $rules = [
        'username'     => 'required|min_length[3]',
        'email'    => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[6]',
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Générer le token
    $token = bin2hex(random_bytes(16));

    // Sauvegarder l'utilisateur avec le token
    $this->userModel->save([
        'username'             => $data['username'],
        'email'            => $data['email'],
        'password'         => password_hash($data['password'], PASSWORD_DEFAULT),
        'activation_token' => $token,
        'is_active'        => 0,
    ]);

    // Envoyer un email de confirmation
    $email = \Config\Services::email();
    $email->setTo($data['email']);
    $email->setFrom('noreply@tonsite.com', 'Validation de Compte');

    $activationLink = base_url("auth/activate/$token");

    $email->setSubject('Confirmez votre inscription');
    $email->setMessage("Bonjour, cliquez sur ce lien pour activer votre compte : <a href=\"$activationLink\">Activer mon compte</a>");

    if ($email->send()) {
        return redirect()->to('/auth/success')->with('success', 'Inscription réussie. Vérifiez votre email pour activer votre compte.');
    } else {
        return redirect()->back()->with('error', 'Échec de l’envoi de l’email. Essayez plus tard.');
    }
}

public function activate($token)
{
    $user = $this->userModel->where('activation_token', $token)->first();

    if (!$user) {
        return redirect()->to('/auth/login')->with('error', 'Lien invalide ou expiré.');
    }

    // Activation du compte
    $this->userModel->update($user['id'], [
        'is_active' => 1,
        'activation_token' => null
    ]);

    return redirect()->to('/auth/login')->with('success', 'Votre compte est maintenant actif. Vous pouvez vous connecter.');
}

public function verify($token = null)
{
    if (!$token) {
        return redirect()->to('/auth/login')->with('error', 'Lien invalide.');
    }

    $user = $this->userModel->where('verification_token', $token)->first();

    if (!$user) {
        return redirect()->to('/auth/login')->with('error', 'Lien invalide ou expiré.');
    }

    $this->userModel->update($user['id'], [
        'is_verified' => true,
        'verification_token' => null,
    ]);

    return redirect()->to('/auth/login')->with('success', 'Adresse vérifiée. Vous pouvez maintenant vous connecter.');
}


    // Déconnexion
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/auth/login')->with('success', 'Vous êtes déconnecté.');
    }

    public function success()
    {
        return view('App\Modules\AuthModule\Views\success');
    }
}
