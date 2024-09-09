<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSomeColumnToPemeriksaanObjectiveTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pemeriksaan_objective', [
            'bb_penurunan_anak' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'bb',
                'null' => true
            ],
        ]);
    }

    public function down()
    {
        //
    }
}
