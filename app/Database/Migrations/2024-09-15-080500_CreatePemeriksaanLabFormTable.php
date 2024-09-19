<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePemeriksaanLabFormTable extends Migration
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
            'id_kunjungan' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,

            ],
            'nama' => [
				'type'           => 'VARCHAR',
				'constraint'     => '100'
			],
            'value' => [
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
        $this->forge->createTable('pemeriksaan_lab_form', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('pemeriksaan_lab_form');
    }
}
