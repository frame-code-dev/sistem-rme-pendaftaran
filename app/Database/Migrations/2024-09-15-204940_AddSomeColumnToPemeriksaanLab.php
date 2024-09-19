<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSomeColumnToPemeriksaanLab extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pemeriksaan_lab', [
            'kunjungan_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                
            ],
        ]);
    }

    public function down()
    {
        //
    }
}
