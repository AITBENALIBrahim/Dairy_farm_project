<?php

namespace App\Models;

use CodeIgniter\Model;

class AnimalVaccineModel extends Model
{
    protected $table      = 'animal_vaccines';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'animal_id', 'animal_type', 'vaccine_name', 'vaccination_date', 'next_vaccine_date', 
        'administered_by', 'created_by', 'employee_id', 'notes', 'created_at', 'updated_at'
    ];

    // Automatically manage timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
