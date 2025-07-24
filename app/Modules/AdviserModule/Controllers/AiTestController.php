<?php

namespace App\Modules\AdviserModule\Controllers;

use App\Controllers\BaseController;
use App\Modules\AdviserModule\Models\AiProviderModel;
use App\Modules\DoctorModule\Libraries\AiRecommender;

class AiTestController extends BaseController
{
    public function index()
    {
        $model = new AiProviderModel();
        $providers = $model->findAll();

        return view('App\Modules\AdviserModule\Views\test_form', [
            'providers' => $providers,
            'response'  => null,
            'prompt'    => '',
            'selectedProvider' => null,
            'error'     => null,
        ]);
    }

    public function send()
    {
        $model = new AiProviderModel();

        $prompt = $this->request->getPost('prompt');
        $providerId = $this->request->getPost('provider');

        $provider = $model->find($providerId);
        if (!$provider) {
            return redirect()->back()->with('error', 'Fournisseur IA non trouvé');
        }

        $response = null;
        $error = null;

        try {
            $ai = new AiRecommender($provider['provider']);
            $response = $ai->getRecommendation($prompt);
        } catch (\Exception $e) {
            $error = $e->getMessage();
        }

        return view('App\Modules\AdviserModule\Views\test_form', [
            'providers' => $model->findAll(),
            'response'  => $response,
            'prompt'    => $prompt,
            'selectedProvider' => $providerId,
            'error'     => $error,
        ]);
    }
}
