<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// app/Modules/OrganizationModule/Models/OrganizationUserModel.php

namespace App\Modules\OrganizationModule\Models;

use CodeIgniter\Model;

class OrganizationUserModel extends Model
{
    protected $table = 'organization_user';
    protected $primaryKey = 'id';
    protected $allowedFields = ['organization_id', 'user_id', 'role'];
    protected $useTimestamps = true;
}
