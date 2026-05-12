<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNikNpwpToAlumni extends Migration
{
    public function up()
    {
        $this->forge->addColumn('alumni', [
            'nik' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
                'after' => 'email',
            ],
            'npwp' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
                'after' => 'nik',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('alumni', ['nik', 'npwp']);
    }
}
