<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'email',
        'username',
        'password_hash',
        'active'
    ];
    protected $useTimestamps = true; // Untuk menangani created_at dan updated_at
}
