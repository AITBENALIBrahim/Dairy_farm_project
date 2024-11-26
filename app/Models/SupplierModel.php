<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table      = 'suppliers';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'contact_number', 'address', 'supplied_items', 'created_by', 'created_at', 'updated_at'];

    // Automatically manage timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
