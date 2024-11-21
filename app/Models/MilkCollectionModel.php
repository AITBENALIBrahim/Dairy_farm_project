<?php

namespace App\Models;

use CodeIgniter\Model;

class MilkCollectionModel extends Model
{
    protected $table      = 'milk_collection';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'cow_id', 'collection_date', 'quantity', 'milk_type', 
        'created_by', 'employee_id', 'created_at', 'updated_at'
    ];

    // Automatically manage timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
