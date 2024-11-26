<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeSalaryModel extends Model
{
    protected $table      = 'employee_salaries';
    protected $primaryKey = 'id';

    protected $allowedFields = ['employee_id', 'amount_paid', 'payment_date', 'payment_method', 'note', 'created_by', 'created_at', 'updated_at'];

    // Automatically set the created_at and updated_at columns to the current timestamp
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
