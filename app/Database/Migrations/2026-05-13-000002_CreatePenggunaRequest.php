<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePenggunaRequest extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id' => [

                'type'           => 'INT',

                'constraint'     => 11,

                'unsigned'       => true,

                'auto_increment' => true,
            ],

            // =====================================================
            // RELASI ALUMNI
            // =====================================================

            'alumni_id' => [

                'type'       => 'INT',

                'constraint' => 11,

                'unsigned'   => true,
            ],

            // =====================================================
            // DATA PERUSAHAAN / HRD
            // =====================================================

            'nama_perusahaan' => [

                'type'       => 'VARCHAR',

                'constraint' => 255,
            ],

            'alamat_perusahaan' => [

                'type' => 'TEXT',

                'null' => true,
            ],

            'email_hrd' => [

                'type'       => 'VARCHAR',

                'constraint' => 255,
            ],

            'nama_penilai' => [

                'type'       => 'VARCHAR',

                'constraint' => 255,

                'null'       => true,
            ],

            'jabatan_penilai' => [

                'type'       => 'VARCHAR',

                'constraint' => 255,

                'null'       => true,
            ],

            'no_telp_penilai' => [

                'type'       => 'VARCHAR',

                'constraint' => 30,

                'null'       => true,
            ],

            // =====================================================
            // TOKEN
            // =====================================================

            'token' => [

                'type'       => 'VARCHAR',

                'constraint' => 255,
            ],

            // =====================================================
            // STATUS
            // =====================================================

            'is_submitted' => [

                'type'       => 'TINYINT',

                'constraint' => 1,

                'default'    => 0,
            ],

            'submitted_at' => [

                'type' => 'DATETIME',

                'null' => true,
            ],

            'expired_at' => [

                'type' => 'DATETIME',

                'null' => true,
            ],

            // =====================================================
            // TIMESTAMP
            // =====================================================

            'created_at' => [

                'type' => 'DATETIME',

                'null' => true,
            ],

            'updated_at' => [

                'type' => 'DATETIME',

                'null' => true,
            ],
        ]);

        // =====================================================
        // KEYS
        // =====================================================

        $this->forge->addKey('id', true);

        $this->forge->addKey('alumni_id');

        $this->forge->addUniqueKey('token');

        // =====================================================
        // CREATE TABLE
        // =====================================================

        $this->forge->createTable('pengguna_request');
    }

    public function down()
    {
        $this->forge->dropTable('pengguna_request');
    }
}
