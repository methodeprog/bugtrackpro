<?php

namespace App\Modules\DoctorModule\Controllers;

use App\Controllers\BaseController;
use App\Modules\DoctorModule\Models\DoctorModel;

class DiagnoseController extends BaseController
{
    protected $doctorModel;

    public function __construct()
    {
        $this->doctorModel = new DoctorModel();
    }

    public function index()
    {
        $data['logs'] = $this->doctorModel->findAll();
        return view('App\Modules\DoctorModule\Views\index', $data);
    }

    public function edit($id)
    {
        $log = $this->doctorModel->find($id);
        if (!$log) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Log not found");
        }

        return view('App\Modules\DoctorModule\Views\edit', ['log' => $log]);
    }

    public function update($id)
    {
        $recommendation = $this->request->getPost('recommendation');

        $this->doctorModel->update($id, ['recommendation' => $recommendation]);

        return redirect()->to('/doctor')->with('success', 'Recommandation mise à jour.');
    }
}
