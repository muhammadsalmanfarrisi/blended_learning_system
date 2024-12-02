<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Password;
use Myth\Auth\Models\GroupModel;


class UserManagement extends BaseController
{
    protected $userModel;
    protected $groupModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->groupModel = new GroupModel();
    }

    public function index()
    {
        // Ambil semua data pengguna dan konversi ke array
        $users = $this->userModel->findAll();
        $usersArray = array_map(function ($user) {
            return $user->toArray();
        }, $users);

        // Kirim data ke view
        return view('admin/user_management', [
            'users' => $usersArray, // Data array
        ]);
    }
    public function create()
    {
        // Ambil data grup dari database
        $groups = $this->groupModel->findAll();

        // Konversi objek stdClass menjadi array
        $groupsArray = json_decode(json_encode($groups), true);

        return view('admin/user_create', [
            'groups' => $groupsArray, // Kirim sebagai array
        ]);
    }

    public function store()
    {
        // Validasi input
        $rules = [
            'email'    => 'required|valid_email|is_unique[users.email]',
            'username' => 'required|alpha_numeric_space|min_length[3]|is_unique[users.username]',
            'password' => 'required|min_length[6]',
            'role'     => 'required|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Enkripsi password
        $hashedPassword = \Myth\Auth\Password::hash($this->request->getPost('password'));


        // Data pengguna
        $userData = [
            'email'         => $this->request->getPost('email'),
            'username'      => $this->request->getPost('username'),
            'password_hash' => $hashedPassword,
            'active'        => 1,
        ];

        // Simpan data pengguna
        $userModel = new \App\Models\UserModel();
        $userId = $userModel->insert($userData);

        if (!$userId) {
            // Debug error model
            return redirect()->back()->withInput()->with('errors', $userModel->errors());
        }

        // Tambahkan pengguna ke grup
        $groupModel = new \Myth\Auth\Models\GroupModel();
        $groupModel->addUserToGroup($userId, $this->request->getPost('role'));

        return redirect()->to('/users')->with('success', 'User berhasil ditambahkan.');
    }



    public function edit($id)
    {
        // Ambil data pengguna berdasarkan ID
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User tidak ditemukan.');
        }

        // Ambil data grup
        $groups = $this->groupModel->findAll();
        $groupsArray = json_decode(json_encode($groups), true);

        // Ambil role user saat ini
        $groupModel = new \Myth\Auth\Models\GroupModel();
        $userGroup = $groupModel->getGroupsForUser($id);

        return view('admin/user_edit', [
            'user'   => array_merge((array)$user, ['role_id' => $userGroup[0]->group_id ?? null]),
            'groups' => $groupsArray,
        ]);
    }

    public function update($id)
    {
        // Validasi input
        $rules = [
            'email'    => "required|valid_email|is_unique[users.email,id,{$id}]",
            'username' => "required|alpha_numeric_space|min_length[3]|is_unique[users.username,id,{$id}]",
            'role'     => 'required|integer',
        ];

        // Password hanya divalidasi jika diisi
        if ($this->request->getPost('password')) {
            $rules['password'] = 'required|min_length[6]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update data pengguna
        $userModel = new \App\Models\UserModel();
        $userData = [
            'email'    => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
        ];

        if ($this->request->getPost('password')) {
            $userData['password_hash'] = \Myth\Auth\Password::hash($this->request->getPost('password'));
        }

        if (!$userModel->update($id, $userData)) {
            return redirect()->back()->withInput()->with('errors', $userModel->errors());
        }

        // Update role pengguna
        $groupModel = new \Myth\Auth\Models\GroupModel();
        $groupModel->removeUserFromAllGroups($id);
        $groupModel->addUserToGroup($id, $this->request->getPost('role'));

        return redirect()->to('/users')->with('success', 'User berhasil diperbarui.');
    }


    public function delete($id)
    {
        if (!$this->userModel->find($id)) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        $this->userModel->delete($id, true); // Hard delete
        return redirect()->to('users')->with('success', 'User berhasil dihapus.');
    }
}
