<?php

namespace App\Modules\AdviserModule\Controllers;

use App\Controllers\BaseController;
use App\Modules\AdviserModule\Models\AiProviderModel;

class AiProviderController extends BaseController
{
    public function index()
    {
        $model = new AiProviderModel();
        $data['providers'] = $model->findAll();
        return view('App\Modules\AdviserModule\Views\providers_list', $data);
    }

    public function create()
    {
        return view('App\Modules\AdviserModule\Views\add_provider');
    }

    public function store()
    {
        $model = new AiProviderModel();

        $model->insert([
            'name'     => $this->request->getPost('name'),
            'provider' => $this->request->getPost('provider'),
            'api_key'  => $this->request->getPost('api_key'),
        ]);

        return redirect()->to('/adviser/ai-providers');
    }

    public function test($id)
    {
        $model = new AiProviderModel();
        $provider = $model->find($id);
    
        if (!$provider) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Provider not found');
        }
    
        return view('App\Modules\AdviserModule\Views\test_provider', ['provider' => $provider, 'response' => null]);
    }
    
    public function sendTest($id)
    {
        $model = new AiProviderModel();
        $provider = $model->find($id);
    
        if (!$provider) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Provider not found');
        }
    
        $prompt = $this->request->getPost('prompt');
    
        $aiRecommender = new \App\Modules\DoctorModule\Libraries\AiRecommender($provider['provider']);
        
        try {
            $response = $aiRecommender->getRecommendation($prompt);
        } catch (\Exception $e) {
            $response = 'Erreur : ' . $e->getMessage();
        }
    
        return view('App\Modules\AdviserModule\Views\test_provider', ['provider' => $provider, 'response' => $response]);
    }
    

}
