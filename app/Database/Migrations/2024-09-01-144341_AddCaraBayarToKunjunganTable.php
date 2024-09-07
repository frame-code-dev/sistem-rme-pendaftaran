<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCaraBayarToKunjunganTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('kunjungan', [
            'cara_bayar' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'after' => 'id_pasien',
                'null' => true
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('kunjungan', 'cara_bayar');
    }
}
