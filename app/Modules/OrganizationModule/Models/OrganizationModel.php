<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// app/Modules/OrganizationModule/Models/OrganizationModel.php

namespace App\Modules\OrganizationModule\Models;

use CodeIgniter\Model;

class OrganizationModel extends Model
{
    protected $table = 'organizations';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'user_id'];
    protected $useTimestamps = true;
}
