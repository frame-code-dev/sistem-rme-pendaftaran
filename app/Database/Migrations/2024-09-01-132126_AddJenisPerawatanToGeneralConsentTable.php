<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddJenisPerawatanToGeneralConsentTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('general_consent', [
            'jenis_perawatan' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'after' => 'status_hubungan_pasien',
                'null' => true
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('general_consent', 'jenis_perawatan');
    }
}
