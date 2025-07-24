<?php

namespace App\Modules\AdviserModule\Models;

use CodeIgniter\Model;

class AiProviderModel extends Model
{
    protected $table = 'ai_providers';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'api_key', 'provider', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
