<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePemeriksaanLabDetailTable extends Migration
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
            'kunjungan_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'nama' => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
                'null'           => true,
			],
            'nilai_normal' => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
                'null'           => true,
			],
            'hasil' => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
                'null'           => true,
			],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('pemeriksaan_lab_detail', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('pemeriksaan_lab_detail');
    }
}
