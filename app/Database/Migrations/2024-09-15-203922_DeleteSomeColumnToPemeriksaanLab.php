<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DeleteSomeColumnToPemeriksaanLab extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('pemeriksaan_lab', [
            'detail',
            'nilai_normal',
            'hasil',
            'satuan',
            'created_at',
            'updated_at'
        ]);
    }

    public function down()
    {
        //
    }
}
