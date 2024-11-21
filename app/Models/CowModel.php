<?php

namespace App\Models;

use CodeIgniter\Model;

class CowModel extends Model
{
    protected $table      = 'cows';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'tag_number', 'date_of_birth', 'health_status', 'stall_id', 
        'sale_status', 'created_by', 'created_at', 'updated_at'
    ];

    // Automatically manage timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
