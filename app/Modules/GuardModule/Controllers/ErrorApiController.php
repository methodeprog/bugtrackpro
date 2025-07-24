<?php

namespace App\Modules\GuardModule\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Modules\GuardModule\Models\ErrorModel;

class ErrorApiController extends ResourceController
{
    protected $modelName = ErrorModel::class;
    protected $format = 'json';

    public function index()
    {
        $errors = $this->model->orderBy('created_at', 'DESC')->findAll();
        return $this->respond($errors);
    }

    public function show($id = null)
    {
        $error = $this->model->find($id);
        if (!$error) {
            return $this->failNotFound('Erreur non trouvée.');
        }
        return $this->respond($error);
    }

    public function store()
    {
        $data = $this->request->getJSON(true) ?? $this->request->getPost();

        if (!$data || empty($data['message'])) {
            return $this->failValidationErrors('Message d’erreur requis.');
        }

        $data['ip_address'] = $this->request->getIPAddress();
        $data['user_agent'] = $this->request->getUserAgent()->getAgentString();

        $this->model->save($data);
        return $this->respondCreated(['status' => 'ok', 'message' => 'Erreur enregistrée.']);
    }
}
