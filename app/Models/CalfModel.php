<?php

namespace App\Models;

use CodeIgniter\Model;

class CalfModel extends Model
{
    protected $table      = 'calves';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'cow_id', 'tag_number', 'date_of_birth', 'health_status', 'stall_id', 
        'created_by', 'employee_id', 'created_at', 'sale_status'
    ];

    // Automatically manage timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
}
