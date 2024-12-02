<?php

namespace App\Models;

use CodeIgniter\Model;

class UserEditModel extends Model
{
    // Nama tabel yang digunakan oleh model ini
    protected $table = 'users'; // Gantilah dengan nama tabel Anda jika berbeda

    // Primary key untuk tabel ini
    protected $primaryKey = 'id'; // Sesuaikan dengan kolom primary key Anda

    // Kolom yang dapat diubah (update)
    protected $allowedFields = [
        'fullname',
        'jenis_kelamin',
        'tanggal_lahir',
        'agama',
        'divisi_kerja',
        'jabatan',
        'alamat',
        'nomor_telepon',
        'tingkat_pendidikan_terakhir',
        'jurusan_program_studi',
        'pengalaman_kerja',
        'user_image'
    ];

    // Gunakan timestamps jika Anda memiliki kolom created_at dan updated_at
    protected $useTimestamps = true; // Jika tabel memiliki kolom created_at dan updated_at
    protected $createdField = 'created_at'; // Nama kolom created_at
    protected $updatedField = 'updated_at'; // Nama kolom updated_at

    // Validasi untuk model ini (opsional, jika perlu menambahkan validasi pada model)
    protected $validationRules = [
        'fullname' => 'required|min_length[3]|max_length[255]',
        'jenis_kelamin' => 'required',
        'tanggal_lahir' => 'required|valid_date',
        'agama' => 'required',
        'divisi_kerja' => 'required',
        'jabatan' => 'required',
        'alamat' => 'required',
        'nomor_telepon' => 'required|numeric',
        'tingkat_pendidikan_terakhir' => 'required',
        'jurusan_program_studi' => 'required',
        'pengalaman_kerja' => 'required',
        'user_image' => 'is_image[user_image]|mime_in[user_image,image/jpg,image/jpeg,image/png]|max_size[user_image,2048]',
    ];

    // Validasi error messages
    protected $validationMessages = [
        'fullname' => [
            'required' => 'Nama lengkap harus diisi.',
            'min_length' => 'Nama lengkap minimal 3 karakter.',
            'max_length' => 'Nama lengkap maksimal 255 karakter.',
        ],
        'jenis_kelamin' => [
            'required' => 'Jenis kelamin harus dipilih.',
        ],
        // Tambahkan validasi untuk kolom lainnya sesuai kebutuhan...
    ];

    // Menambahkan metode untuk mencari user berdasarkan ID
    public function findUserById($id)
    {
        return $this->where('id', $id)->first();
    }
}
