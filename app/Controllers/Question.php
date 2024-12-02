<?php

namespace App\Controllers;

use App\Models\QuestionModel;
use App\Models\AnswerModel;

class Question extends BaseController
{
    public function index($module_id)
    {
        $questionModel = new QuestionModel();
        $answerModel = new AnswerModel();

        // Get all questions for the specific module
        $questions = $questionModel->getQuestionsByModuleId($module_id);

        // Attach answers to each question
        foreach ($questions as &$question) {
            $question['answers'] = $answerModel->getAnswers($question['id']);
        }

        $data['questions'] = $questions;
        $data['module_id'] = $module_id;

        return view('question/index', $data);
    }

    public function create($module_id)
    {
        $data['module_id'] = $module_id; // Mengambil module_id dari modul yang sedang dibuka
        return view('question/create', $data);
    }
    public function store($module_id)
    {
        $questionModel = new QuestionModel();
        $data = [
            'module_id' => $module_id,
            'question_text'  => $this->request->getPost('question')
        ];
        $questionModel->save($data);
        return redirect()->to('/question/index/' . $data['module_id']);
    }

    public function edit($id)
    {
        $questionModel = new QuestionModel();
        $question = $questionModel->find($id);
        if (!$id) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Question not found");
        }
        return view('question/edit', ['question' => $question]);
    }

    public function update($id)
    {
        $questionModel = new QuestionModel();
        $data = [
            'question_text' => $this->request->getPost('question')
        ];
        $questionModel->update($id, $data);
        return redirect()->to('/question/index/' . $this->request->getPost('module_id'));
    }

    public function delete($id)
    {
        $questionModel = new QuestionModel();
        $question_modul = $questionModel->find($id);
        $questionModel->delete($id);
        return redirect()->to('/question/index/' . $question_modul['module_id']);
    }
}
