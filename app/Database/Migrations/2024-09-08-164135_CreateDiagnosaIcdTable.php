<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDiagnosaIcdTable extends Migration
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
            'diagnosa_kode' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'null'       => true,
            ],
            'diagnosa_nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'null'       => true,
            ],
            'diagnosa_ket' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('diagnosa_sembilan', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('diagnosa_sembilan');
    }
}
