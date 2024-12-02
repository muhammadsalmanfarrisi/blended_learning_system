<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateResultsTable extends Migration
{
    public function up()
    {
        // Create the 'results' table
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'auto_increment' => true],
            'user_id'     => ['type' => 'INT', 'unsigned' => true],
            'module_id'   => ['type' => 'INT'],
            'score'       => ['type' => 'INT'],
            'submitted_at' => ['type' => 'DATETIME', 'null' => true], // For submission timestamp
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE'); // Assuming 'users' table has 'id'
        $this->forge->addForeignKey('module_id', 'modules', 'id', 'CASCADE', 'CASCADE'); // Assuming 'modules' table has 'id'
        $this->forge->createTable('results');
    }

    public function down()
    {
        // Drop the 'results' table
        $this->forge->dropTable('results');
    }
}
