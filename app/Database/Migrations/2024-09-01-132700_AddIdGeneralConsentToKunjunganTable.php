<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIdGeneralConsentToKunjunganTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('kunjungan', [
            'id_general_consent' => [
                'type' => 'INT',
                'after' => 'id_pasien',
                'null' => true
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('kunjungan', 'id_general_consent');
    }
}
