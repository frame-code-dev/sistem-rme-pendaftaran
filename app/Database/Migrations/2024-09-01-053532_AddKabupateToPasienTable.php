<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKabupateToPasienTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pasien', [
            'kabupaten' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'after' => 'kecamatan',
                'null' => true
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pasien', 'kabupaten');
    }
}
