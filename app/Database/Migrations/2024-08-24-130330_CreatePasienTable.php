<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePasienTable extends Migration
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
            'no_rm' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'nik' => [
                'type' => 'INT',
                'constraint' => 16,
                
            ],
            'no_bpjs' => [
                'type' => 'INT',
                'constraint' => 16,
                'null' => true,
            ],
            'nama_lengkap' => [
                'type'           => 'VARCHAR',
				'constraint'     => '200'
            ],
            'tempat_lahir' => [
                'type'           => 'VARCHAR',
				'constraint'     => '200'
            ],
            'tanggal_lahir' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'jenis_kelamin' => [
                'type'       => 'ENUM',
                'constraint' => ['L', 'P'],
            ],
            'jenis_pasien' => [
                'type'       => 'ENUM',
                'constraint' => ['BPJS', 'UMUM'],
            ],
            'nama_kk' => [
                'type'           => 'VARCHAR',
				'constraint'     => '200'
            ],
            'no_kk' => [
                'type' => 'INT',
                'constraint' => 16,
            ],
            'alamat_lengkap' => [
                'type' => 'TEXT',
            ],
            'provinsi' => [
                'type' => 'BIGINT',
            ],
            'kecamatan' => [
                'type' => 'BIGINT',
            ],
            'desa' => [
                'type' => 'BIGINT',
            ],
            'kode_pos' => [
                'type' => 'INT',
                'constraint' => 10,
            ],
            'keterangan_wilayah' => [
                'type'           => 'VARCHAR',
				'constraint'     => '200',
                'null'           => true,
            ],
            'agama' => [
                'type'           => 'VARCHAR',
				'constraint'     => '100',
                'null'           => true,
            ],
            'gol_darah' => [
                'type'           => 'VARCHAR',
				'constraint'     => '5',
                'null'           => true,
            ],
            'pendidikan' => [
                'type'           => 'VARCHAR',
				'constraint'     => '100',
                'null'           => true,
            ],
            'pekerjaan' => [
                'type'           => 'VARCHAR',
				'constraint'     => '100',
                'null'           => true,
            ],
            'status_nikah' => [
                'type'           => 'VARCHAR',
				'constraint'     => '100',
                'null'           => true,
            ],
            'nama_ayah' => [
                'type'           => 'VARCHAR',
				'constraint'     => '200',
                'null'           => true,
            ],
            'nama_ibu' => [
                'type'           => 'VARCHAR',
				'constraint'     => '200',
                'null'           => true,
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
        $this->forge->createTable('pasien', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('pasien');
    }
}
