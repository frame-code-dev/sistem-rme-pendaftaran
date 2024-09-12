<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSomeColumnToPemeriksaanAssesmentTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pemeriksaan_assesment', [
            'jenis_penglihatan' => [
                'type' => 'TEXT',
                'after' => 'user_id',
                'null' => true,
                'default' => 'Baik'
            ],
            'jenis_pendengaran' => [
                'type' => 'TEXT',
                'after' => 'user_id',
                'null' => true,
                'default' => 'Baik'
            ],
        ]);
    }

    public function down()
    {
        //
    }
}
