<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSomeColumnToGeneralConsentTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('general_consent', [
            'privasi_khusus' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'after' => 'status_hubungan_pasien',
                'null' => true
            ],
            'permintaan_privasi_khusus' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'after' => 'privasi_khusus',
                'null' => true
            ],
            'akses_keluarga' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'after' => 'permintaan_privasi_khusus',
                'null' => true
            ],
            'cara_bayar' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'after' => 'akses_keluarga',
                'null' => true
            ],
            'signature_penanggung' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'after' => 'cara_bayar',
                'null' => true
            ],
            'signature_petugas' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'after' => 'signature_penanggung',
                'null' => true
            ],
            
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('general_consent',[
            'privasi_khusus',
            'permintaan_privasi_khusus',
            'akses_keluarga',
            'cara_bayar',
            'signature_penanggung',
            'signature_petugas',]);
    }
}
