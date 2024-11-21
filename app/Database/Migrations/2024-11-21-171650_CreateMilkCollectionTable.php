<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMilkCollectionTable extends Migration
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
            'collection_date' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'quantity' => [
                'type'    => 'DECIMAL',
                'constraint' => '10,2',
                'null'    => false,
            ],
            'milk_type' => [
                'type'    => 'VARCHAR',
                'constraint' => '50',
                'null'    => false,
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
            'updated_at' => [
                'type'    => 'TIMESTAMP',
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id', true); // Primary Key
        $this->forge->addForeignKey('cow_id', 'cows', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('created_by', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('employee_id', 'employees', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('milk_collection');
    }

    public function down()
    {
        $this->forge->dropTable('milk_collection');
    }
}
