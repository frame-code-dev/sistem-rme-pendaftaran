<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePemeriksaanLabTable extends Migration
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
            'jenis_pemeriksaan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'detail' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'nilai_normal' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'hasil' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'satuan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('pemeriksaan_lab', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('pemeriksaan_lab');
    }
}
