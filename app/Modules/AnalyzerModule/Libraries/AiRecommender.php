<?php

namespace App\Modules\DoctorModule\Libraries;

use App\Modules\AdviserModule\Models\AiProviderModel;

class AiRecommender
{
    protected $apiKey;
    protected $provider;

    public function __construct(string $providerName = 'openai')
    {
        $model = new AiProviderModel();
        $provider = $model->where('provider', $providerName)->first();

        if (!$provider) {
            throw new \Exception("Fournisseur IA '{$providerName}' non trouvé.");
        }

        $this->apiKey = $provider['api_key'];
        $this->provider = $provider['provider'];
    }

    public function getRecommendation(string $prompt): ?string
    {
        switch ($this->provider) {
            case 'openai':
                return $this->callOpenAI($prompt);

            case 'huggingface':
                return $this->callHuggingFace($prompt);

            // Ajouter d'autres fournisseurs ici

            default:
                throw new \Exception("Fournisseur IA '{$this->provider}' non supporté.");
        }
    }

    protected function callOpenAI(string $prompt): ?string
    {
        $data = [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'Tu es un assistant expert en debug applicatif. Donne des recommandations concrètes pour corriger les erreurs de code.'],
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => 0.7,
        ];

        return $this->callAPI('https://api.openai.com/v1/chat/completions', $data, [
            'Authorization: Bearer ' . $this->apiKey,
            'Content-Type: application/json',
        ]);
    }

    protected function callHuggingFace(string $prompt): ?string
    {
        // Exemple minimal, à adapter selon l'API HuggingFace utilisée
        $data = ['inputs' => $prompt];

        return $this->callAPI('https://api-inference.huggingface.co/models/bert-base-uncased', $data, [
            'Authorization: Bearer ' . $this->apiKey,
            'Content-Type: application/json',
        ]);
    }

    protected function callAPI(string $url, array $payload, array $headers): ?string
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

        $result = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($result, true);

        // Gestion des réponses pour OpenAI
        if ($this->provider === 'openai' && isset($response['choices'][0]['message']['content'])) {
            return $response['choices'][0]['message']['content'];
        }

        // Gestion basique pour HuggingFace (adapter selon réponse)
        if ($this->provider === 'huggingface' && isset($response[0]['generated_text'])) {
            return $response[0]['generated_text'];
        }

        // En cas d'échec, retourne null ou message d'erreur simplifié
        return null;
    }
}
