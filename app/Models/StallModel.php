<?php

namespace App\Models;

use CodeIgniter\Model;

class StallModel extends Model
{
    protected $table      = 'stalls';
    protected $primaryKey = 'id';

    protected $allowedFields = ['stall_number', 'capacity', 'occupied', 'created_by', 'employee_id', 'created_at'];

    // Automatically set the created_at column to the current timestamp
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
}
