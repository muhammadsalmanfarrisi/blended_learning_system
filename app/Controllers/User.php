<?php

namespace App\Controllers;

use App\Models\UserEditModel;

class User extends BaseController
{
    public function index(): string
    {
        $user = user(); // Fungsi dari Myth/Auth untuk mendapatkan data pengguna yang sedang login

        return view('user/index', [
            'user' => $user
        ]);
    }

    public function edit()
    {
        $user = user();

        return view('user/edit', [
            'user' => $user
        ]);
    }

    public function update($id)
    {
        $userModel = new UserEditModel(); // Gunakan model kustom untuk mendukung kolom tambahan

        // Validasi input
        $rules = [
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
            
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Proses upload gambar
        // $userImage = $this->request->getFile('user_image');
        // $imageName = $this->request->getPost('current_image'); // Gambar lama jika tidak ada upload baru

        // if ($userImage && $userImage->isValid() && !$userImage->hasMoved()) {
        //     $imageName = $userImage->getRandomName();
        //     $userImage->move(ROOTPATH . 'public/uploads/foto', $imageName);
        // }

        // Update data
        $data = [
            'fullname' => $this->request->getPost('fullname'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'agama' => $this->request->getPost('agama'),
            'divisi_kerja' => $this->request->getPost('divisi_kerja'),
            'jabatan' => $this->request->getPost('jabatan'),
            'alamat' => $this->request->getPost('alamat'),
            'nomor_telepon' => $this->request->getPost('nomor_telepon'),
            'tingkat_pendidikan_terakhir' => $this->request->getPost('tingkat_pendidikan_terakhir'),
            'jurusan_program_studi' => $this->request->getPost('jurusan_program_studi'),
            'pengalaman_kerja' => $this->request->getPost('pengalaman_kerja'),
            // 'user_image' => $imageName,
        ];

        if ($userModel->update($id, $data)) {
            return redirect()->to('user')->with('success', 'Profile updated successfully.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to update profile.');
        }
    }
}
