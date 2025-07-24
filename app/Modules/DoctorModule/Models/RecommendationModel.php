<?php

namespace App\Modules\DoctorModule\Models;

use CodeIgniter\Model;

class RecommendationModel extends Model
{
    protected $table = 'error_logs'; // ou "bugs", selon ta base
    protected $primaryKey = 'id';
    protected $allowedFields = ['message', 'context', 'stack_trace', 'created_at'];
}
