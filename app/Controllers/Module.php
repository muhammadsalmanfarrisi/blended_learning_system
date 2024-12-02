<?php

namespace App\Controllers;

use App\Models\ModuleModel;
use App\Models\MaterialModel;
use App\Models\QuestionModel;
use App\Models\AnswerModel;
use App\Models\ResultModel;
use App\Models\VideoModel;
use Myth\Auth\Models\UserModel;

class Module extends BaseController
{
    protected $moduleModel;
    protected $materialModel;
    protected $videoModel;
    protected $resultModel;

    public function __construct()
    {
        $this->moduleModel = new ModuleModel();
        $this->materialModel = new MaterialModel();
        $this->videoModel = new VideoModel();
        $this->resultModel = new ResultModel();
    }

    public function index()
    {
        $data['modules'] = $this->moduleModel->findAll();
        return view('modules/index', $data);
    }

    public function index_user()
    {
        $data['modules'] = $this->moduleModel->findAll();
        return view('modules_user/index', $data);
    }

    public function create()
    {
        return view('modules/create');
    }

    public function store()
    {
        $this->moduleModel->save([
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description')
        ]);
        return redirect()->to('/modules');
    }

    public function edit($id)
    {
        $data['module'] = $this->moduleModel->find($id);
        return view('modules/edit', $data);
    }

    public function update($id)
    {
        $this->moduleModel->update($id, [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description')
        ]);
        return redirect()->to('/modules');
    }

    public function delete($id)
    {
        $this->moduleModel->delete($id);
        return redirect()->to('/modules');
    }


    public function view_user($id)
    {
        // Ambil data module
        $data['module'] = $this->moduleModel->find($id);

        // Ambil data materi terkait
        $data['materials'] = $this->materialModel->where('module_id', $id)->findAll();

        // Ambil data video terkait
        $data['videos'] = $this->videoModel->getVideosByModuleId($id);

        // Cek apakah user sudah menyelesaikan pretest

        $userId = user()->id;  // Ambil user_id dari session
        $result = $this->resultModel
            ->where('user_id', $userId)
            ->where('module_id', $id)
            ->where('is_completed', 1)
            ->first();  // Cari data pretest yang sudah diselesaikan

        // Jika sudah selesai, set flag untuk menampilkan tombol pretest dan ambil skor
        $data['pretestCompleted'] = !empty($result);

        // Jika pretest selesai, ambil skor dan waktu submit
        if ($data['pretestCompleted']) {
            $data['score'] = $result['score'];
            $data['submitted_at'] = $result['submitted_at'];
        }

        return view('modules_user/view', $data);
    }






    public function submit($module_id)
    {
        $questionModel = new QuestionModel();
        $answerModel = new AnswerModel();
        $resultModel = new ResultModel();
        $db = \Config\Database::connect();
        $builder =   $db->table('users');

        // Mengambil ID pengguna yang sedang login
        $user_id = session()->get('user_id'); // Pastikan session berisi ID pengguna yang sedang login
        $total_score = 0;

        // Ambil semua pertanyaan berdasarkan modul
        $questions = $questionModel->getQuestionsByModuleId($module_id);

        foreach ($questions as $question) {
            // Ambil ID jawaban yang dipilih oleh peserta
            $selected_answer_id = $this->request->getPost('question_' . $question['id']);

            // Cek apakah jawaban benar
            if ($selected_answer_id) {
                $selected_answer = $answerModel->find($selected_answer_id);
                if ($selected_answer['is_correct'] == 1) {
                    $total_score++;
                }
            }
        }

        // Simpan hasil nilai ke tabel results
        $resultModel->save([
            'user_id' => $user_id,
            'module_id' => $module_id,
            'score' => $total_score,
        ]);

        // Redirect atau tampilkan hasil
        return redirect()->to('/module/result/' . $module_id);
    }



    // Method untuk menyimpan materi baru ke database
    public function storeMaterial()
    {
        $module_id = $this->request->getPost('module_id');

        // Cek apakah ada file PDF yang di-upload
        $file = $this->request->getFile('file');
        $filePath = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName(); // Beri nama acak pada file
            $file->move('uploads/materials', $fileName); // Simpan di folder uploads/materials
            $filePath = 'uploads/materials/' . $fileName;
        }

        // Simpan data ke database
        $this->materialModel->save([
            'module_id' => $module_id,
            'title' => $this->request->getPost('title'),
            'file_path' => $filePath
        ]);

        return redirect()->to('/module/view/' . $module_id);
    }


    // Method untuk menampilkan halaman edit materi
    public function editMaterial($material_id)
    {
        $material = $this->materialModel->find($material_id);
        if (!$material) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Material tidak ditemukan');
        }

        $data['material'] = $material;
        return view('materials/edit', $data);
    }

    public function updateMaterial($material_id)
    {
        $material = $this->materialModel->find($material_id);
        if (!$material) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Material tidak ditemukan');
        }

        $module_id = $material['module_id'];
        $filePath = $material['file_path']; // Path file material yang lama

        // Cek apakah ada file baru yang di-upload
        $file = $this->request->getFile('file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $extension = $file->getClientExtension();
            $fileName = $file->getRandomName();
            $fileName = pathinfo($fileName, PATHINFO_FILENAME) . '.' . $extension;
            $file->move('uploads/materials', $fileName);
            $filePath = 'uploads/materials/' . $fileName;

            // Hapus file material lama
            if (file_exists($material['file_path'])) {
                unlink($material['file_path']);
            }
        }

        // Update data di database
        $this->materialModel->update($material_id, [
            'title' => $this->request->getPost('title'),
            // 'content' => $this->request->getPost('content'),
            'file_path' => $filePath
        ]);

        return redirect()->to('/module/view/' . $module_id);
    }

    // Method untuk menghapus materi
    public function deleteMaterial($id)
    {
        $materialModel = new MaterialModel();
        $material = $materialModel->find($id);

        // Jika materi ditemukan dan ada file yang diunggah
        if ($material) {
            // Hapus file fisik dari server
            if (file_exists(ROOTPATH . 'public/' . $material['file_path'])) {
                unlink(ROOTPATH . 'public/' . $material['file_path']);
            }

            // Hapus data materi dari database
            $materialModel->delete($id);

            return redirect()->to('/module/view/' . $material['module_id']);
        }

        return redirect()->to('/module');
    }

    // Method untuk menampilkan detail modul beserta daftar materi yang terhubung
    public function view($id)
    {
        $data['module'] = $this->moduleModel->find($id);
        $data['materials'] = $this->materialModel->where('module_id', $id)->findAll();
        $data['videos'] = $this->videoModel->getVideosByModuleId($id);

        return view('modules/view', $data);
    }
    // public function view($id)
    // {
    //     $moduleModel = new ModuleModel();
    //     $materialModel = new MaterialModel();
    //     $questionModel = new QuestionModel();
    //     $answerModel = new AnswerModel();

    //     $data['module'] = $moduleModel->find($id);
    //     $data['materials'] = $materialModel->getMaterialsByModuleId($id);
    //     $data['questions'] = $questionModel->getQuestionsByModuleId($id);
    //     foreach ($data['questions'] as $key => $question) {
    //         $data['questions'][$key]['answers'] = $answerModel->where('question_id', $question['id'])->findAll();
    //     }

    //     return view('modules/view', $data);
    // }
    public function addVideo($module_id)
    {
        $data['module_id'] = $module_id; // Mengambil module_id dari modul yang sedang dibuka
        return view('videos/create', $data);
    }

    // Method untuk menyimpan video baru ke database
    public function storeVideo()
    {
        $module_id = $this->request->getPost('module_id');

        // Cek apakah ada file video yang di-upload
        $file = $this->request->getFile('file');
        $filePath = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $extension = $file->getClientExtension(); // Mengambil ekstensi asli file
            $fileName = $file->getRandomName(); // Beri nama acak pada file
            $fileName = pathinfo($fileName, PATHINFO_FILENAME) . '.' . $extension; // Gabungkan nama acak dan ekstensi asli
            $file->move('uploads/videos', $fileName); // Simpan di folder uploads/videos
            $filePath = 'uploads/videos/' . $fileName;
        }

        // Simpan data ke database
        $this->videoModel->save([
            'module_id' => $module_id,
            'title' => $this->request->getPost('title'),
            'file_path' => $filePath
        ]);

        return redirect()->to('/module/view/' . $module_id);
    }
    public function editVideo($video_id)
    {
        $video = $this->videoModel->find($video_id);
        if (!$video) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Video tidak ditemukan');
        }

        $data['video'] = $video;
        return view('videos/edit', $data);
    }

    public function updateVideo($video_id)
    {
        $video = $this->videoModel->find($video_id);
        if (!$video) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Video tidak ditemukan');
        }

        $module_id = $video['module_id'];
        $filePath = $video['file_path']; // Path file video yang lama

        // Cek apakah ada file video baru yang di-upload
        $file = $this->request->getFile('file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $extension = $file->getClientExtension();
            $fileName = $file->getRandomName();
            $fileName = pathinfo($fileName, PATHINFO_FILENAME) . '.' . $extension;
            $file->move('uploads/videos', $fileName);
            $filePath = 'uploads/videos/' . $fileName;

            // Hapus file video lama
            if (file_exists($video['file_path'])) {
                unlink($video['file_path']);
            }
        }

        // Update data di database
        $this->videoModel->update($video_id, [
            'title' => $this->request->getPost('title'),
            'file_path' => $filePath
        ]);

        return redirect()->to('/module/view/' . $module_id);
    }

    // Method untuk menghapus video
    public function deleteVideo($id)
    {
        $video = $this->videoModel->find($id);

        // Jika video ditemukan dan ada file yang diunggah
        if ($video) {
            // Hapus file fisik dari server
            if (file_exists(ROOTPATH . 'public/' . $video['file_path'])) {
                unlink(ROOTPATH . 'public/' . $video['file_path']);
            }

            // Hapus data video dari database
            $this->videoModel->delete($id);

            return redirect()->to('/module/view/' . $video['module_id']);
        }

        return redirect()->to('/module');
    }
    public function grafik()
    {
        $resultModel = new ResultModel();

        // Ambil ID pengguna yang sedang login
        $userId = user()->id;

        // Tanggal awal (hari ini)
        $startDate = date('Y-m-d');

        // Data untuk grafik (10 hari berturut-turut dari hari ini)
        $days = [];
        $values = [];

        for ($i = 0; $i < 10; $i++) {
            $date = date('Y-m-d', strtotime("$startDate +$i days"));
            $days[] = "Hari " . ($i + 1);

            $query = $resultModel
                ->select('SUM(score) as total_score, COUNT(id) as count_data')
                ->where('user_id', $userId)
                ->where('DATE(submitted_at)', $date)
                ->first();

            $totalScore = $query['total_score'] ?? 0;
            $countData = $query['count_data'] ?? 0;

            // Hitung rata-rata nilai
            $averageScore = ($countData > 0) ? $totalScore / $countData : 0;

            $values[] = $averageScore;
        }

        // Ambil ranking semua pengguna
        $rankings = $resultModel->getRankings();

        // Ambil ranking untuk pengguna yang sedang login
        $userRanking = $resultModel->getUserRanking($userId);

        // Temukan posisi ranking pengguna
        $userPosition = 0;
        foreach ($rankings as $index => $ranking) {
            if ($ranking['user_id'] == $userId) {
                $userPosition = $index + 1;
                break;
            }
        }

        // Siapkan data untuk view
        $data = [
            'days' => $days,
            'values' => $values,
            'userRanking' => $userRanking,
            'rankings' => $rankings,
            'userPosition' => $userPosition
        ];

        return view('chart_view', $data);
    }


    public function kalender()
    {
        return view('kalender');
    }
    public function pretest($module_id)
    {
        $questionModel = new QuestionModel();
        $answerModel = new AnswerModel();

        $data['questions'] = $questionModel->getQuestionsByModuleId($module_id);

        // Get answers for each question
        foreach ($data['questions'] as &$question) {
            $question['answers'] = $answerModel->getAnswers($question['id']);
        }

        $data['module_id'] = $module_id;
        return view('modules/pretest', $data);
    }


    public function submitPretest($module_id)
    {
        // Initialize models
        $questionModel = new QuestionModel();
        $answerModel = new AnswerModel();
        $resultModel = new ResultModel();

        // Get the logged-in user's ID using Myth\Auth
        $user_id = user()->id;
        if (!$user_id) {
            // Redirect or handle error if no user is logged in
            return redirect()->to('/login')->with('error', 'You need to be logged in to submit the pretest.');
        }

        // Initialize total score
        $total_score = 0;

        // Get all questions for the given module
        $questions = $questionModel->getQuestionsByModuleId($module_id);

        // Count the total number of questions for the module
        $total_questions = count($questions);

        // Loop through questions and check user's answers
        foreach ($questions as $question) {
            // Get the selected answer for each question from the POST data
            $selected_answer_id = $this->request->getPost('question_' . $question['id']);

            if ($selected_answer_id) {
                // Find the selected answer
                $selected_answer = $answerModel->find($selected_answer_id);

                // If the selected answer is correct, increment the score
                if ($selected_answer && $selected_answer['is_correct']) {
                    $total_score++;
                }
            }
        }

        // Calculate the percentage score and round it to the nearest integer
        $score_percentage = intval(($total_score / $total_questions) * 100);



        // Log the result for debugging
        log_message('debug', 'User ID: ' . $user_id . ', Module ID: ' . $module_id . ', Score: ' . $score_percentage);

        // Get the current date and time for the submission
        date_default_timezone_set('Asia/Jakarta');
        $submitted_at = date('Y-m-d');

        // Attempt to save the result for the user
        $saved = $resultModel->save([
            'user_id' => $user_id,
            'module_id' => $module_id,
            'score' => $score_percentage,  // Save the rounded percentage score
            'submitted_at' => $submitted_at,  // Save the submission timestamp
            'is_completed' => 1,  // Save the submission timestamp
        ]);

        if (!$saved) {
            log_message('error', 'Failed to save result for User ID: ' . $user_id . ' in Module ID: ' . $module_id);
            // Redirect with error if saving fails
            return redirect()->to('/modules_user/view/' . $module_id)->with('error', 'Failed to submit pretest.');
        }

        // Redirect to the result page for the module
        return redirect()->to('/modules_user/view/' . $module_id)->with('success', 'Pretest submitted successfully!');
    }




    public function result($module_id)
    {
        $resultModel = new ResultModel();

        // Get the logged-in user's ID
        $user_id = session()->get('user_id');

        // Get the result for the user in the specified module
        $result = $resultModel->where('user_id', $user_id)->where('module_id', $module_id)->first();

        // Pass the result to the view
        $data['result'] = $result;

        // Load the result view with the user's score
        return view('modules/result', $data);
    }

    // public function result($module_id)
    // {
    //     $resultModel = new ResultModel();
    //     $userModel = new UserModel();

    //     // Ambil hasil ujian untuk pengguna yang sedang login
    //     $user_id = session()->get('user_id');
    //     $result = $resultModel->where('user_id', $user_id)->where('module_id', $module_id)->first();

    //     // Tampilkan hasil
    //     if ($result) {
    //         $data['result'] = $result;
    //         return view('modules/result', $data);
    //     } else {
    //         return redirect()->to('/module');
    //     }
    // }
    public function addMaterial($module_id)
    {
        $data['module_id'] = $module_id; // Mengambil module_id dari modul yang sedang dibuka
        return view('materials/create', $data);
    }
}
