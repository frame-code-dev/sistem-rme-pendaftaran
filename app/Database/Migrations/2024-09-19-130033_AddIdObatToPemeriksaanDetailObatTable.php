<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIdObatToPemeriksaanDetailObatTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pemeriksaan_detail_obat', [
            'id_obat' => [
                'type' => 'INT',
                'constraint' => 5,
            ]
        ]);
    }

    public function down()
    {
        //
    }
}
