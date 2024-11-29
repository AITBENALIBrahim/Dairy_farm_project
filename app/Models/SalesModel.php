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


    public function get_all_sales()
    {
        return $this->orderBy('sale_date', 'DESC')->findAll();
    }

    // Fetch a specific sale by ID
    public function get_sale_by_id($id)
    {
        return $this->find($id);
    }

    // Insert a new sale
    public function add_sale($data)
    {
        return $this->insert($data);
    }

    // Update an existing sale
    public function update_sale($id, $data)
    {
        return $this->update($id, $data);
    }

    // Delete a sale
    public function delete_sale($id)
    {
        return $this->delete($id);
    }
}

