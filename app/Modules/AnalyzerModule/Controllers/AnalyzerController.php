<?php

namespace App\Modules\DoctorModule\Controllers;

use App\Controllers\BaseController;
use App\Modules\DoctorModule\Models\RecommendationModel;
use App\Modules\DoctorModule\Services\RecommenderService;
use App\Modules\GuardModule\Models\GuardLogModel;

class DoctorController extends BaseController
{
    protected $recommender;

    public function __construct()
    {
        $this->recommender = new RecommenderService();
    }

    public function index()
    {
        return view('App\Modules\DoctorModule\Views\index');
    }

    public function recommendation($errorId)
    {
        $recommendation = $this->recommender->generateRecommendation($errorId);

        return $this->response->setJSON([
            'error_id' => $errorId,
            'recommendation' => $recommendation
        ]);
    }


    public function getErrors()
{
    $model = new \App\Modules\DoctorModule\Models\RecommendationModel();
    $errors = $model->orderBy('created_at', 'DESC')->findAll(10); // Dernières 10 erreurs
    return $this->response->setJSON($errors);
}

public function edit($id)
{
    $model = new GuardLogModel();
    $log = $model->find($id);

    if (!$log) {
        return redirect()->back()->with('error', 'Erreur introuvable.');
    }

    return view('DoctorModule\Views\edit', ['log' => $log]);
}

public function update($id)
{
    $model = new GuardLogModel();
    $recommendation = $this->request->getPost('recommendation');

    $model->update($id, ['recommendation' => $recommendation]);

    return redirect()->to('/guard')->with('success', 'Recommandation ajoutée.');
}


public function generateAIRecommendation($logId)
{
    $logModel = new \App\Modules\GuardModule\Models\GuardLogModel();
    $log = $logModel->find($logId);

    if (!$log) {
        return redirect()->back()->with('error', 'Erreur non trouvée.');
    }

    try {
        $ai = new \App\Modules\DoctorModule\Libraries\AiRecommender('openai'); // on peut changer 'openai' par le provider voulu dynamiquement
        $recommendation = $ai->getRecommendation($log['error_message']);

        if ($recommendation) {
            $logModel->update($logId, ['recommendation' => $recommendation]);
            return redirect()->back()->with('success', 'Recommandation IA ajoutée avec succès.');
        }

        return redirect()->back()->with('error', 'Impossible de générer une recommandation.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage());
    }
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
