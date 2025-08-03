<?php

namespace App\Modules\ProjectModule\Controllers;

use App\Modules\ProjectModule\Models\ProjectModel;
use App\Modules\OrganizationModule\Models\OrganizationModel;
use App\Controllers\BaseController;

class ProjectController extends BaseController
{
public function all()
{
    $projectModel = new ProjectModel();
    $organizationModel = new OrganizationModel();

    $data['projects'] = $projectModel->findAll();
    $organizations = $organizationModel->findAll();

    // Transformer la liste en tableau id => nom pour un accès rapide
    $orgMap = [];
    foreach ($organizations as $org) {
        $orgMap[$org['id']] = $org['name'];
    }
    $data['organizations'] = $orgMap;

    return view('ProjectModule\projects\all', $data);
}

    public function createFromAll()
    {
        $orgModel = new OrganizationModel();
        $data['organizations'] = $orgModel->findAll();

        return view('ProjectModule\projects\create_from_all', $data);
    }

    public function index($organizationId)
    {
        $model = new ProjectModel();
        $data['projects'] = $model->where('organization_id', $organizationId)->findAll();

        return view('ProjectModule\projects\index', $data);
    }

    public function create($organizationId)
    {
        $orgModel = new OrganizationModel();
        $organization = $orgModel->find($organizationId);

        if (!$organization) {
            return redirect()->back()->with('error', 'Organisation introuvable');
        }

        $currentUserId = session()->get('user_id');
        if ($organization['user_id'] != $currentUserId) {
            return redirect()->back()->with('error', 'Accès non autorisé');
        }

        return view('ProjectModule\projects\create', ['organization_id' => $organizationId]);
    }

    public function store()
    {
        $orgModel = new OrganizationModel();
        $organizationId = $this->request->getPost('organization_id');
        $organization = $orgModel->find($organizationId);

        $currentUserId = session()->get('user_id');
        if (!$organization || $organization['user_id'] != $currentUserId) {
            return redirect()->back()->with('error', 'Action interdite');
        }

        if (!$this->validate([
            'name' => 'required|min_length[3]',
            'description' => 'permit_empty|string',
            'url' => 'required|valid_url',
        ])) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $model = new ProjectModel();

        $data = [
            'organization_id' => $organizationId,
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'url' => $this->request->getPost('url'),
        ];

        $model->insert($data);

        return redirect()->to('dashboard/projects/' . $organizationId)
                         ->with('success', 'Projet créé avec succès.');
    }

    public function edit($projectId)
    {
        $projectModel = new ProjectModel();
        $organizationModel = new OrganizationModel();

        $project = $projectModel->find($projectId);

        if (!$project) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Projet introuvable : $projectId");
        }

        $currentUserId = session()->get('user_id');
        $organization = $organizationModel->find($project['organization_id']);

        if (!$organization || $organization['user_id'] != $currentUserId) {
            return redirect()->back()->with('error', 'Accès non autorisé pour modifier ce projet.');
        }

        return view('ProjectModule\projects\edit', ['project' => $project]);
    }

    public function update($projectId)
    {
        $projectModel = new ProjectModel();
        $organizationModel = new OrganizationModel();

        $project = $projectModel->find($projectId);
        if (!$project) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Projet introuvable : $projectId");
        }

        $currentUserId = session()->get('user_id');
        $organization = $organizationModel->find($project['organization_id']);
        if (!$organization || $organization['user_id'] != $currentUserId) {
            return redirect()->back()->with('error', 'Accès non autorisé pour modifier ce projet.');
        }

        if (!$this->validate([
            'name' => 'required|min_length[3]',
            'description' => 'permit_empty|string',
            'url' => 'required|valid_url',
        ])) {
            return redirect()->back()
                ->withInput()
                ->with('validation', $this->validator);
        }

        $data = [
            'id' => $projectId,
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'url' => $this->request->getPost('url'),
        ];

        $projectModel->save($data);

        return redirect()->to(site_url('dashboard/projects/' . $project['organization_id']))
                         ->with('success', 'Projet mis à jour avec succès.');
    }
}
