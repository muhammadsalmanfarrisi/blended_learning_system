<?php

namespace App\Models;

use CodeIgniter\Model;

class ResultModel extends Model
{
    protected $table      = 'results';         // Nama tabel
    protected $primaryKey = 'id';              // Primary key

    protected $allowedFields = [
        'user_id',
        'module_id',
        'score',
        'submitted_at',
        'is_completed'
    ];

    protected $useTimestamps = false; // Tidak menggunakan fitur timestamps otomatis

    // Aturan validasi
    protected $validationRules = [
        'user_id'       => 'required|integer',
        'module_id'     => 'required|integer',
        'score'         => 'permit_empty|decimal',
        'submitted_at'  => 'permit_empty|valid_date',
        'is_completed'  => 'permit_empty|in_list[0,1]',
    ];

    // Pesan validasi
    protected $validationMessages = [
        'submitted_at' => [
            'valid_date' => 'The submitted date is not valid.'
        ],
        'is_completed' => [
            'in_list' => 'The completion status must be 0 (not completed) or 1 (completed).'
        ]
    ];

    // Fungsi untuk mengecek apakah pretest sudah selesai
    public function isPretestCompleted($userId, $moduleId)
    {
        return $this->where('user_id', $userId)
                    ->where('module_id', $moduleId)
                    ->where('is_completed', 1)
                    ->first();
    }
    public function getRankings()
    {
        return $this->select('user_id, AVG(score) as average_score')
                    ->where('is_completed', 1) // Hanya hitung jika sudah selesai
                    ->groupBy('user_id')
                    ->orderBy('average_score', 'DESC')
                    ->findAll();
    }
    public function getUserRanking($userId)
    {
        return $this->select('user_id, AVG(score) as average_score')
                    ->where('user_id', $userId)
                    ->groupBy('user_id')
                    ->orderBy('average_score', 'DESC')
                    ->first();
    }
}
