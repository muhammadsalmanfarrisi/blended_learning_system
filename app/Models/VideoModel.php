<?php

namespace App\Models;

use CodeIgniter\Model;

class VideoModel extends Model
{
    protected $table      = 'videos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['module_id', 'title', 'file_path'];
    protected $useTimestamps = true;

    public function getVideosByModuleId($module_id)
    {
        return $this->where('module_id', $module_id)->findAll();
    }
}
