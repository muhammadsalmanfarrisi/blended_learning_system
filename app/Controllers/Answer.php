<?php

namespace App\Controllers;

use App\Models\AnswerModel;
use App\Models\QuestionModel;

class Answer extends BaseController
{
    public function index($question_id)
    {
        $answerModel = new AnswerModel();
        $answers = $answerModel->getAnswers($question_id);

        return view('answer/index', ['answers' => $answers, 'question_id' => $question_id]);
    }
    public function create($question_id)
    {
        $data['question_id'] = $question_id;

        $questionModel = new QuestionModel();
        $question = $questionModel->find($question_id);

        if ($question && isset($question['module_id'])) {
            $data['module_id'] = $question['module_id'];
        } else {
            return redirect()->back()->with('error', 'Pertanyaan atau module_id tidak ditemukan.');
        }

        // Ambil opsi yang sudah digunakan


        return view('answer/create', $data);
    }


    public function store($question_id)
    {
        $answerModel = new AnswerModel();
        $questionModel = new QuestionModel();

        // Ambil data pertanyaan untuk mendapatkan module_id
        $question = $questionModel->find($question_id);
        if (!$question) {
            return redirect()->back()->with('error', 'Question not found.');
        }

        $module_id = $question['module_id']; // Pastikan 'module_id' ada dalam tabel 'questions'

        // Simpan data jawaban
        $data = [
            'question_id' => $question_id,
            'answer' => $this->request->getPost('answer'),
            'is_correct' => $this->request->getPost('is_correct'),
        ];

        $answerModel->insert($data);

        // Redirect ke halaman list pertanyaan berdasarkan module_id
        return redirect()->to(site_url('question/' . $module_id))->with('success', 'Answer created successfully.');
    }



    public function edit($answer_id)
    {
        $answerModel = new AnswerModel();
        $questionModel = new QuestionModel();

        // Ambil data jawaban berdasarkan ID
        $answer = $answerModel->find($answer_id);
        if (!$answer) {
            return redirect()->back()->with('error', 'Answer not found.');
        }

        // Ambil question_id dan module_id untuk redirect nantinya
        $question = $questionModel->find($answer['question_id']);
        if (!$question) {
            return redirect()->back()->with('error', 'Question not found.');
        }

        $data = [
            'answer' => $answer,
            'question_id' => $answer['question_id'],
            'module_id' => $question['module_id'],
        ];

        return view('answer/edit', $data);
    }


    public function update($answer_id)
    {
        $answerModel = new AnswerModel();
        $questionModel = new QuestionModel();

        // Ambil data jawaban untuk validasi dan redirect
        $answer = $answerModel->find($answer_id);
        if (!$answer) {
            return redirect()->back()->with('error', 'Answer not found.');
        }

        $question = $questionModel->find($answer['question_id']);
        if (!$question) {
            return redirect()->back()->with('error', 'Question not found.');
        }

        $module_id = $question['module_id'];

        // Validasi input dan update data
        $data = [
            'answer' => $this->request->getPost('answer'),
            'is_correct' => $this->request->getPost('is_correct'),
        ];

        $answerModel->update($answer_id, $data);

        return redirect()->to(site_url('question/' . $module_id))->with('success', 'Answer updated successfully.');
    }


    public function delete($answer_id)
    {
        $answerModel = new AnswerModel();
        $questionModel = new QuestionModel();

        // Ambil data jawaban untuk validasi dan redirect
        $answer = $answerModel->find($answer_id);
        if (!$answer) {
            return redirect()->back()->with('error', 'Answer not found.');
        }

        // Ambil question_id dan module_id
        $question = $questionModel->find($answer['question_id']);
        if (!$question) {
            return redirect()->back()->with('error', 'Question not found.');
        }

        $module_id = $question['module_id'];

        // Hapus data jawaban
        $answerModel->delete($answer_id);

        return redirect()->to(site_url('question/' . $module_id))->with('success', 'Answer deleted successfully.');
    }
}
