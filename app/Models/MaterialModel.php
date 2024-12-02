<?php

namespace App\Models;

use CodeIgniter\Model;

class MaterialModel extends Model
{
    protected $table = 'materials';
    protected $primaryKey = 'id';
    protected $allowedFields = ['module_id', 'title', 'content', 'file_path'];

    public function getMaterialsByModuleId($module_id)
    {
        return $this->where('module_id', $module_id)->findAll();
    }
}
