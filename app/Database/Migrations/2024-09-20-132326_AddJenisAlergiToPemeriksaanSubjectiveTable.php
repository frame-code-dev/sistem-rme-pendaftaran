<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddJenisAlergiToPemeriksaanSubjectiveTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pemeriksaan_subjective',[
            'alergi' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'after' => 'riwayat_text',
                'null' => true,
            ],
            'alergi_lainnya' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'after' => 'alergi',
                'after' => 'riwayat_text',
                'null' => true
            ],
        ]);
    }

    public function down()
    {
        //
    }
}
