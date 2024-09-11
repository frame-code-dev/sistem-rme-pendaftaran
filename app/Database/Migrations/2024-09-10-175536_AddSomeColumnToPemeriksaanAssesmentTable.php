<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSomeColumnToPemeriksaanAssesmentTable extends Migration
{
    public function up()
    {
        // $this->forge->dropColumn('pemeriksaan_assesment', [
        //     'diagnosa_id',	
        //     'jenis_keluhan',	
        //     'keluhan_data',	
        //     'jenis_riwayat',	
        //     'riwayat_data',	
        //     'merokok',	
        //     'kurang_makan_sayur_buah',	
        //     'stres',	
        //     'kurang_aktivitas_fisik',	
        //     'konsumsi_alkohol',
        // ]);
        $this->forge->addColumn('pemeriksaan_assesment', [
            'assesment_keperawatan' => [
                'type' => 'TEXT',
                'after' => 'user_id',
                'null' => true
            ],
            'assesment_keperawatan_lainnya' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'user_id',
                'null' => true
            ],
            'intervensi_keperawatan' => [
                'type' => 'TEXT',
                'after' => 'user_id',
                'null' => true
            ],
            'intervensi_keperawatan_lainnya' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'user_id',
                'null' => true
            ],
            'diagnosa_sepluh' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'user_id',
                'null' => true
            ],
            'diagnosa_sepluh_kode' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'user_id',
                'null' => true
            ],
            'diagnosa_kasus' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'user_id',
                'null' => true
            ],
            'tindakan' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'user_id',
                'null' => true
            ],
            'tindakan_kode' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'user_id',
                'null' => true
            ],
            'tindakan_kasus' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'user_id',
                'null' => true
            ],
            'jenis_keperluan' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'user_id',
                'null' => true
            ],
            'dokter_pemeriksa' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'user_id',
                'null' => true
            ],
            'status_pasien_keluar' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'user_id',
                'null' => true
            ],
            'kesadaran' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'user_id',
                'null' => true
            ],
            'rujukan_internal' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'user_id',
                'null' => true
            ],
            'rujukan_internal_poli' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'user_id',
                'null' => true
            ],
            'rujukan_eksternal' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'user_id',
                'null' => true
            ],
            'rujukan_eksternal_detail' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'user_id',
                'null' => true
            ],
            'alasan_rujukan' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'user_id',
                'null' => true
            ],
            'signature_dokter' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'user_id',
                'null' => true
            ],

        ]);
    }

    public function down()
    {
        //
    }
}
