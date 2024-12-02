<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAnswersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'question_id' => [
                'type'       => 'INT',
                'constraint' => 11
            ],
            'answer' => [
                'type'       => 'TEXT',
                'null'       => false
            ],
            'option' => [
                'type'       => 'ENUM',
                'constraint' => ['A', 'B', 'C', 'D'],
                'null'       => false
            ],
            'is_correct' => [
                'type'       => 'BOOLEAN',
                'default'    => false
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('question_id', 'questions', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('answers');
    }

    public function down()
    {
        $this->forge->dropTable('answers');
    }
}
