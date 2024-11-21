<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesModel extends Model
{
    protected $table      = 'sales';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'sale_type', 'animal_id', 'sale_date', 'quantity_liters', 'price_per_liter', 
        'sale_price', 'buyer_name', 'invoice_number', 'payment_status', 'created_by', 
        'created_at', 'updated_at'
    ];

    // Automatically manage timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
