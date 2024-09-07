<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGeneralConsentTable extends Migration
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
            'pasien_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,

            ],
            'nama_lengkap' => [
				'type'           => 'VARCHAR',
				'constraint'     => '100'
			],
            'tempat_lahir' => [
				'type'           => 'TEXT',
                'null'           => true,
			],
            'tanggal_lahir' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'alamat_lengkap' => [
				'type'           => 'TEXT',
                'null'           => true,
			],
            'no_hp' => [
				'type'           => 'VARCHAR',
				'constraint'     => '13',
                'null'           => true,
			],
            'status_hubungan_pasien' => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
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
        $this->forge->createTable('general_consent', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('general_consent', TRUE);
    }
}
