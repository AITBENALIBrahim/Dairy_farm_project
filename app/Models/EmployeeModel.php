<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table            = 'employees';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'name', 
        'position', 
        'salary', 
        'hire_date', 
        'status', 
        'created_by', 
        'created_at', 
        'updated_at'
    ];

    // Allowing timestamps if you want to auto-manage 'created_at' and 'updated_at'
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
