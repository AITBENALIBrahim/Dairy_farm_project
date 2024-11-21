<?php

namespace App\Models;

use CodeIgniter\Model;

class FeedChartModel extends Model
{
    protected $table      = 'feed_chart';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'cow_id', 'feed_time', 'feed_type', 'quantity', 
        'date', 'created_by', 'employee_id', 'created_at'
    ];

    // Automatically manage timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
}
