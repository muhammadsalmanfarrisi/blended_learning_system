<?php

namespace App\Models;

use CodeIgniter\Model;

class QuestionModel extends Model
{
    protected $table = 'questions';
    protected $primaryKey = 'id';
    protected $allowedFields = ['module_id', 'question_text'];

    public function getQuestionsByModuleId($module_id)
    {
        return $this->where('module_id', $module_id)->findAll();
    }
}
