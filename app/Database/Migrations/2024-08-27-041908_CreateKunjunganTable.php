<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKunjunganTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_pasien' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'no_antrian' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'poli' => [
                'type'       => 'ENUM',
                'constraint' => ['POLI UMUM', 'POLI GIGI', 'POLI KIA'],
            ],
            'status_kunjungan' => [
                'type'       => 'ENUM',
                'constraint' => ['BARU', 'LAMA'],
            ],
            'status_pemeriksaan' => [
                'type'       => 'ENUM',
                'constraint' => ['PENDING', 'DILAYANIN','SELESAI','BATAL'],
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
        $this->forge->createTable('kunjungan', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('kunjungan');
    }
}
