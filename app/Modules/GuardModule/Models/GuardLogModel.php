<?php

namespace App\Modules\GuardModule\Models;

use CodeIgniter\Model;

class GuardLogModel extends Model
{
    protected $table = 'guard_logs';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'client_id', 'url', 'http_method', 'status_code',
        'error_message', 'error_trace', 'recommendation',
        'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;
}
