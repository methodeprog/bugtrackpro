<?php

namespace App\Modules\DoctorModule\Models;

use CodeIgniter\Model;

class DiagnoseModel extends Model
{
    protected $table = 'diagnose_logs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['error_log_id', 'recommendation', 'ai_recommendation'];
}
