<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePemeriksaanDetailObatTable extends Migration
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
            'dosis_obat' => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
                'null'           => true,
			],
            
            'aturan_obat' => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
                'null'           => true,
			],
            
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('pemeriksaan_detail_obat', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('pemeriksaan_detail_obat');
    }
}
