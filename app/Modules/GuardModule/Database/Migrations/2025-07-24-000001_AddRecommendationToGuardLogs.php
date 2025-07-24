<?php

namespace App\Modules\GuardModule\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRecommendationToGuardLogs extends Migration
{
    public function up()
    {
        $this->forge->addColumn('guard_logs', [
            'recommendation' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'error_trace'
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('guard_logs', 'recommendation');
    }
}
