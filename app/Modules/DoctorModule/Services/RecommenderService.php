<?php

namespace App\Modules\DoctorModule\Services;

use App\Modules\DoctorModule\Models\RecommendationModel;

class RecommenderService
{
    protected $model;

    public function __construct()
    {
        $this->model = new RecommendationModel();
    }

    public function generateRecommendation($errorId)
    {
        $error = $this->model->find($errorId);

        if (!$error) {
            return 'Erreur inconnue ou non trouvée.';
        }

        // ⚠️ Logique de base — à remplacer par une vraie IA/API plus tard
        if (str_contains($error['message'], 'Undefined variable')) {
            return 'Vérifiez si la variable est déclarée avant utilisation.';
        }

        if (str_contains($error['message'], 'SQLSTATE')) {
            return 'Vérifiez la requête SQL et les connexions à la base de données.';
        }

        return 'Aucune recommandation spécifique trouvée pour cette erreur.';
    }
}
