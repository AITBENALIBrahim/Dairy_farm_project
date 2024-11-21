<?php

namespace App\Models;

use CodeIgniter\Model;

class ExpenseModel extends Model
{
    protected $table      = 'expenses';
    protected $primaryKey = 'id';

    protected $allowedFields = ['expense_date', 'expense_type', 'amount', 'description', 'created_by', 'created_at'];

    // Automatically manage timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
}
