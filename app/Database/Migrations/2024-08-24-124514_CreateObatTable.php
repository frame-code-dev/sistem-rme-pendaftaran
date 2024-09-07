<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateObatTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,

            ],
            'nama' => [
				'type'           => 'VARCHAR',
				'constraint'     => '100'
			],
            'satuan' => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
                'null'           => true,
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
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('obat', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('obat');
    }
}
