<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRelationToPenggunaLulusan extends Migration
{
    public function up()
    {
        $fields = [

            'alumni_id' => [

                'type'       => 'INT',

                'constraint' => 11,

                'unsigned'   => true,

                'null'       => true,

                'after'      => 'id',
            ],

            'request_id' => [

                'type'       => 'INT',

                'constraint' => 11,

                'unsigned'   => true,

                'null'       => true,

                'after'      => 'alumni_id',
            ],
        ];

        $this->forge->addColumn(
            'pengguna_lulusan',
            $fields
        );
    }

    public function down()
    {
        $this->forge->dropColumn(
            'pengguna_lulusan',
            ['alumni_id', 'request_id']
        );
    }
}
