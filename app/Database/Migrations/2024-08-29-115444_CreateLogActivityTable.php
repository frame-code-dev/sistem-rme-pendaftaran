<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLogActivityTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'action' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'ip_address' => [
                'type' => 'TEXT',
                'null' => true,

            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]); 
        $this->forge->addKey('id', true);
        $this->forge->createTable('log_activity');
    }

    public function down()
    {
        $this->forge->dropTable('log_activity');
    }
}
