<?php

namespace App\Modules\AdviserModule\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAiProviders extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'name'         => ['type' => 'VARCHAR', 'constraint' => 100],
            'api_key'      => ['type' => 'TEXT'],
            'provider'     => ['type' => 'VARCHAR', 'constraint' => 50], // ex: openai, huggingface
            'created_at'   => ['type' => 'DATETIME', 'null' => true],
            'updated_at'   => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('ai_providers');
    }

    public function down()
    {
        $this->forge->dropTable('ai_providers');
    }
}
