<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSomeColumnToPemeriksaanLab extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pemeriksaan_lab', [
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
                'after' => 'jenis_pemeriksaan',
                'null'       => true,
            ],
        ]);
    }

    public function down()
    {
        //
    }
}
