<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFeedChartTable extends Migration
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
            'cow_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'feed_time' => [
                'type' => 'TIME',
                'null' => false,
            ],
            'feed_type' => [
                'type'    => 'VARCHAR',
                'constraint' => '100',
                'null'    => false,
            ],
            'quantity' => [
                'type'    => 'DECIMAL',
                'constraint' => '10,2',
                'null'    => false,
            ],
            'date' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'created_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'employee_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id', true); // Primary Key
        $this->forge->addForeignKey('cow_id', 'cows', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('created_by', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('employee_id', 'employees', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('feed_chart');
    }

    public function down()
    {
        $this->forge->dropTable('feed_chart');
    }
}
