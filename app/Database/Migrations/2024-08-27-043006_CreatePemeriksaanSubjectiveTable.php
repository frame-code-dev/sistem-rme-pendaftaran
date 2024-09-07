<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePemeriksaanSubjectiveTable extends Migration
{
    public function up()
    {
        // pemeriksaan subjektif
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_kunjungan' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,

            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['utama', 'tambahan'],
                'default' => 'utama',
            ],
            'complaint' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'smoking' => [
                'type' => 'ENUM',
                'constraint' => ['Ya', 'Tidak'],
                'default' => 'Tidak',
            ],
            'diet' => [
                'type' => 'ENUM',
                'constraint' => ['Ya', 'Tidak'],
                'default' => 'Tidak',
            ],
            'physical_activity' => [
                'type' => 'ENUM',
                'constraint' => ['Ya', 'Tidak'],
                'default' => 'Tidak',
            ],
            'alcohol_consumption' => [
                'type' => 'ENUM',
                'constraint' => ['Ya', 'Tidak'],
                'default' => 'Tidak',
            ],
            'stress' => [
                'type' => 'ENUM',
                'constraint' => ['Ya', 'Tidak'],
                'default' => 'Tidak',
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['dahulu', 'sekarang', 'keluarga', 'pengobatan'],
                'default' => 'sekarang',
            ],
            'history' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
          
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('pemeriksaan_subjective', TRUE);
        // pemeriksaan objectif 
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'kunjungan_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'ttd_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'null'       => true,
            ],
            'kondisi_umum' => [
                'type'       => 'ENUM',
                'constraint' => ['Baik', 'Sedang', 'Lemah'],
                'null'       => true,
            ],
            'kesadaran_e' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'null'       => true,
            ],
            'kesadaran_v' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'null'       => true,
            ],
            'kesadaran_m' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'null'       => true,
            ],
            'tingkat_kesadaran' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'tekanan_darah' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'null'       => true,
            ],
            'respiratory_rate' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'null'       => true,
            ],
            'nadi' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'null'       => true,
            ],
            'spo2' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'null'       => true,
            ],
            'suhu' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'null'       => true,
            ],
            'berat_badan' => [
                'type'       => 'FLOAT',
                'null'       => true,
            ],
            'tinggi_badan' => [
                'type'       => 'FLOAT',
                'null'       => true,
            ],
            'imt' => [
                'type'       => 'FLOAT',
                'null'       => true,
            ],
            'lingkar_perut' => [
                'type'       => 'FLOAT',
                'null'       => true,
            ],
            'skala_nyeri' => [
                'type'       => 'ENUM',
                'constraint' => ['Anak Usia > 3 Tahun', 'Dewasa'],
                'null'       => true,
            ],
            'tingkat_nyeri_anak' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'null'       => true,
            ],
            'jenis_nyeri_anak' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'keterangan_nyeri_anak' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'tingkat_nyeri_dewasa' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'null'       => true,
            ],
            'jenis_nyeri_dewasa' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'keterangan_nyeri_dewasa' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'lokasi_nyeri' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'durasi' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'rasa_nyeri' => [
                'type'       => 'ENUM',
                'constraint' => ['Tajam', 'Nyeri Tumpul', 'Nyeri Ditarik', 'Nyeri Kram', 'Nyeri Dipukul', 'Nyeri Ditusuk', 'Nyeri Berdenyut', 'Nyeri Ditikam'],
                'null'       => true,
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('pemeriksaan_objective', TRUE);
        // pemeriksaan  assesment
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'kunjungan_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'diagnosa_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'jenis_keluhan' => [
                'type'           => 'ENUM',
                'constraint'     => ['Utama', 'Tambahan'],
                'default'        => 'Utama',
            ],
            'keluhan_data' => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'jenis_riwayat' => [
                'type'           => 'ENUM',
                'constraint'     => ['Dahulu', 'Sekarang', 'Keluarga', 'Pengobatan'],
                'default'        => 'Dahulu',
            ],
            'riwayat_data' => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'merokok' => [
                'type'           => 'BOOLEAN',
                'default'        => false,
            ],
            'kurang_makan_sayur_buah' => [
                'type'           => 'BOOLEAN',
                'default'        => false,
            ],
            'stres' => [
                'type'           => 'BOOLEAN',
                'default'        => false,
            ],
            'kurang_aktivitas_fisik' => [
                'type'           => 'BOOLEAN',
                'default'        => false,
            ],
            'konsumsi_alkohol' => [
                'type'           => 'BOOLEAN',
                'default'        => false,
            ],
            'created_at' => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'updated_at' => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('pemeriksaan_assesment', TRUE);
        // pemeriksaan planning 
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'kunjungan_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'ttd_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'null'       => true,
            ],
            'jenis_keluhan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'keluhan_detail' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'riwayat_penyakit' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'riwayat_detail' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'merokok' => [
                'type'       => 'BOOLEAN',
                'default'    => false,
            ],
            'kurang_makan_sayur_buah' => [
                'type'       => 'BOOLEAN',
                'default'    => false,
            ],
            'stress' => [
                'type'       => 'BOOLEAN',
                'default'    => false,
            ],
            'kurang_aktivitas_fisik' => [
                'type'       => 'BOOLEAN',
                'default'    => false,
            ],
            'konsumsi_alkohol' => [
                'type'       => 'BOOLEAN',
                'default'    => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('pemeriksaan_planning', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('pemeriksaan_subjective');
        $this->forge->dropTable('pemeriksaan_objective');
        $this->forge->dropTable('pemeriksaan_assesment');
        $this->forge->dropTable('pemeriksaan_planning');
    }
}
