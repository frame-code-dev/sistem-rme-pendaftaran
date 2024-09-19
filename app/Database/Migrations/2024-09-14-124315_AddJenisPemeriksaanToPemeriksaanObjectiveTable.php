<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddJenisPemeriksaanToPemeriksaanObjectiveTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pemeriksaan_objective', [
            'jenis_pemeriksaaan' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'user_id',
                'null' => true
            ],
        ]);
    }

    public function down()
    {
        //
    }
}
