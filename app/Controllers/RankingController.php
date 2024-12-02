<?php
// File: app/Controllers/RankingController.php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ResultModel;
use Myth\Auth\Models\UserModel;

class RankingController extends BaseController
{
    public function index()
    {
        $resultModel = new ResultModel();
        $userModel = new UserModel();

        // Dapatkan data ranking
        $rankings = $resultModel->getRankings();

        // Gabungkan dengan informasi pengguna
        foreach ($rankings as &$ranking) {
            $user = $userModel->find($ranking['user_id']);
            $ranking['username'] = $user ? $user->username : 'Unknown'; // Menggunakan objek
        }

        return view('rankings/index', ['rankings' => $rankings]);
    }
    public function index2()
    {
        $resultModel = new ResultModel();
        $userModel = new UserModel();

        // Ambil ID pengguna yang sedang login
        $userId = user_id(); // Fungsi dari Myth/Auth untuk mendapatkan user_id

        // Ambil ranking untuk pengguna yang sedang login
        $userRanking = $resultModel->getUserRanking($userId);

        // Ambil semua ranking
        $rankings = $resultModel->getRankings();

        // Temukan posisi ranking pengguna
        $userPosition = 0;
        foreach ($rankings as $index => $ranking) {
            if ($ranking['user_id'] == $userId) {
                $userPosition = $index + 1;
                break;
            }
        }

        return view('module/grafik', [
            'userRanking' => $userRanking,
            'rankings' => $rankings,
            'userPosition' => $userPosition
        ]);
    }
}
