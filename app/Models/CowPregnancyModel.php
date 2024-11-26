<?php

namespace App\Models;

use CodeIgniter\Model;

class CowPregnancyModel extends Model
{
    protected $table      = 'cow_pregnancies';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'cow_id', 'pregnancy_start_date', 'expected_delivery_date', 'notes', 
        'created_by', 'employee_id', 'created_at'
    ];

    // Automatically manage timestamps
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
}