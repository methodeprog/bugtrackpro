<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Jwt extends BaseConfig
{
    public string $secretKey = 'ton_secret_hautement_securise_ici'; // Change ça !
    public int $expireTime = 3600; // en secondes, ex: 1 heure
}
