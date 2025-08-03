<?php

namespace App\Modules\AuthModule\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'email', 'password'];
    protected $returnType = 'array';
    protected $useTimestamps = true; // Si tu as created_at et updated_at
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
