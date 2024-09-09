<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSomeColumnToPemeriksaanSubjectiveTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pemeriksaan_subjective', [
            'jenis_keluhan' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'after' => 'type',
                'null' => true
            ],
            'riwayat_text' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'type',
                'null' => true
            ],
        ]);
        $this->forge->addColumn('pemeriksaan_objective', [
            'bb' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'rasa_nyeri',
                'null' => true
            ],
            'appetite' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'rasa_nyeri',
                'null' => true
            ],
            'condition' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'rasa_nyeri',
                'null' => true
            ],
            'kepala' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'rasa_nyeri',
                'null' => true
            ],
            'thorax' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'rasa_nyeri',
                'null' => true
            ],
            'abdomen' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'rasa_nyeri',
                'null' => true
            ],
            'ekstremitas' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'rasa_nyeri',
                'null' => true
            ],
            'lainnya' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'rasa_nyeri',
                'null' => true
            ],
            'status_mental' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'rasa_nyeri',
                'null' => true
            ],
            'respon_emosi' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'rasa_nyeri',
                'null' => true
            ],
            'bahasa' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'rasa_nyeri',
                'null' => true
            ],
            'kebutuhan_spiritual' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'rasa_nyeri',
                'null' => true
            ],
            'hubungan_dengan_keluarga' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'rasa_nyeri',
                'null' => true
            ],
            'tindak_lanjut' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'after' => 'rasa_nyeri',
                'null' => true
            ],
        ]);
    }

    public function down()
    {

    }
}
