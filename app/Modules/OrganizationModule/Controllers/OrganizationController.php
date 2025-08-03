<?php

namespace App\Modules\OrganizationModule\Controllers;

use App\Controllers\BaseController;
use App\Modules\OrganizationModule\Models\OrganizationModel;

class OrganizationController extends BaseController
{
    protected $model;
    protected $session;

    public function __construct()
    {
        $this->model = new OrganizationModel();
        $this->session = session(); // Initialise la session
    }

    // Affiche le formulaire de création
    public function createForm()
    {
        return view('OrganizationModule\Views\create', [
            'validation' => \Config\Services::validation()
        ]);
    }

    // Enregistre une organisation
    public function store()
    {
        // Récupère l'utilisateur connecté
        $userId = $this->session->get('user_id');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Vous devez être connecté pour créer une organisation.');
        }

        // Récupère les données du formulaire
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'user_id' => $userId
        ];

        // Valide les données
        if (!$this->validate([
            'name' => 'required|min_length[2]',
            'description' => 'permit_empty|max_length[255]',
        ])) {
            return view('OrganizationModule\Views\create', [
                'validation' => $this->validator
            ]);
        }

        $this->model->save($data);

        return redirect()->to('dashboard/organizations')->with('success', 'Organisation créée avec succès.');
    }

    // Liste les organisations de l'utilisateur connecté
    public function index()
    {
        $userId = $this->session->get('user_id');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter pour voir vos organisations.');
        }

        $organizations = $this->model
            ->where('user_id', $userId)
            ->findAll();

        return view('OrganizationModule\Views\index', [
            'organizations' => $organizations
        ]);
    }
    
    // Affiche le formulaire d'édition d'une organisation
public function edit($id)
{
    $userId = $this->session->get('user_id');
    if (!$userId) {
        return redirect()->to('/login')->with('error', 'Veuillez vous connecter.');
    }

    $organization = $this->model
        ->where('id', $id)
        ->where('user_id', $userId)
        ->first();

    if (!$organization) {
        return redirect()->to('dashboard/organizations')->with('error', "Organisation non trouvée.");
    }

    return view('OrganizationModule\Views\edit', [
        'organization' => $organization,
        'validation' => \Config\Services::validation()
    ]);
}

// Met à jour l'organisation
public function update($id)
{
    $userId = $this->session->get('user_id');
    if (!$userId) {
        return redirect()->to('/login')->with('error', 'Connexion requise.');
    }

    $organization = $this->model
        ->where('id', $id)
        ->where('user_id', $userId)
        ->first();

    if (!$organization) {
        return redirect()->to('dashboard/organizations')->with('error', 'Organisation introuvable.');
    }

    $data = [
        'name' => $this->request->getPost('name'),
        'description' => $this->request->getPost('description'),
    ];

    if (!$this->validate([
        'name' => 'required|min_length[2]',
        'description' => 'permit_empty|max_length[255]'
    ])) {
        return view('OrganizationModule\Views\edit', [
            'organization' => $organization,
            'validation' => $this->validator
        ]);
    }

    $this->model->update($id, $data);

    return redirect()->to('dashboard/organizations')->with('success', 'Organisation mise à jour avec succès.');
}

}
