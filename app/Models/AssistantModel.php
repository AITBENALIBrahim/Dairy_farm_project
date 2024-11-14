<?php

namespace App\Models;

use CodeIgniter\Model;

class AssistantModel extends Model
{
    protected $table = 'assistants';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'email', 'password', 'created_by', 'created_at', 'updated_at', 'deleted_at', 'reset_token', 'token_expires_at', 'birth', 'gender', 'photo', 'role'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Define the relationship with the admin (users table)
    public function getAdmin()
    {
        return $this->join('users', 'users.id = assistants.created_by', 'left')
                    ->select('users.username AS admin_username, users.email AS admin_email');
    }
}

