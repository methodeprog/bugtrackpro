<?php

namespace App\Modules\GuardModule\Models;

use CodeIgniter\Model;

class ErrorModel extends Model
{
    protected $table            = 'error_logs';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'app_name', 'environment', 'error_type', 'message',
        'file', 'line', 'trace', 'url', 'ip_address', 'user_agent',
        'created_at', 'updated_at'
    ];

    protected $useTimestamps    = true;
}
