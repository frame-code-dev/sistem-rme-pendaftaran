<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTanggalKunjunganToKunjunganTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('kunjungan', [
            'tanggal_kunjungan' => [
                'type' => 'DATE',
                'after' => 'id_pasien',
                'null' => true
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('kunjungan', 'tanggal_kunjungan');
    }
}
