<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCalvesTable extends Migration
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
            'tag_number' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'unique'     => true,
            ],
            'date_of_birth' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'health_status' => [
                'type'    => 'VARCHAR',
                'constraint' => '50',
                'default' => 'healthy',
            ],
            'stall_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
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
            'sale_status' => [
                'type'    => 'ENUM',
                'constraint' => ['available', 'sold'],
                'default' => 'available',
            ],
        ]);

        $this->forge->addKey('id', true); // Primary Key
        $this->forge->addForeignKey('cow_id', 'cows', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('stall_id', 'stalls', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('created_by', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('employee_id', 'employees', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('calves');
    }

    public function down()
    {
        $this->forge->dropTable('calves');
    }
}
