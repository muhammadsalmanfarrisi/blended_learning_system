<?php

namespace App\Models;

use CodeIgniter\Model;

class AnswerModel extends Model
{
    protected $table      = 'answers';
    protected $primaryKey = 'id';
    protected $allowedFields = ['question_id', 'answer', 'option', 'is_correct', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getAnswers($question_id)
    {
        return $this->where('question_id', $question_id)->findAll();
    }
}
