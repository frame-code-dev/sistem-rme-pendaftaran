<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSomeColumnToPemeriksaanLab extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pemeriksaan_lab', [
            'ttd_pemeriksa' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
                'after' => 'jenis_pemeriksaan',
                'null'       => true,
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
    }

    public function down()
    {
        //
    }
}
