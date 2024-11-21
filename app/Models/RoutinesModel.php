<?php

namespace App\Models;

use CodeIgniter\Model;

class RoutinesModel extends Model
{
    protected $table      = 'routines';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'animal_id', 'animal_type', 'routine_type', 'description', 
        'frequency', 'created_by', 'employee_id', 'created_at', 'updated_at'
    ];

    // Automatically manage timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
