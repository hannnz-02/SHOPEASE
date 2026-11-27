<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // ==========================================
    // MENAMPILKAN DAFTAR PENGGUNA + PAGINATION
    // ==========================================
    public function index()
    {
        $keyword = trim($this->request->getGet('keyword') ?? '');
        $role = $this->request->getGet('role') ?? '';

        // Pencarian berdasarkan nama atau email
        if ($keyword !== '') {
            $this->userModel
                ->groupStart()
                    ->like('name', $keyword)
                    ->orLike('email', $keyword)
                ->groupEnd();
        }

        // Filter berdasarkan role
        $allowedRoles = ['admin', 'operator', 'customer'];

        if (in_array($role, $allowedRoles, true)) {
            $this->userModel->where('role', $role);
        } else {
            $role = '';
        }

        // Pagination: 10 pengguna per halaman
        $users = $this->userModel
            ->orderBy('id_user', 'DESC')
            ->paginate(10, 'users');

        $pager = $this->userModel->pager;

        return view('admin/users/index', [
            'title' => 'User Management',
            'users' => $users,
            'keyword' => $keyword,
            'selectedRole' => $role,
            'pager' => $pager
        ]);
    }


    // ==========================================
    // MENAMPILKAN FORM EDIT
    // ==========================================
    public function edit($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('/admin/users')
                ->with('error', 'Pengguna tidak ditemukan.');
        }

        return view('admin/users/edit', [
            'title' => 'Edit User',
            'user' => $user
        ]);
    }


    // ==========================================
    // MEMPERBARUI DATA PENGGUNA
    // ==========================================
    public function update($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('/admin/users')
                ->with('error', 'Pengguna tidak ditemukan.');
        }

        $currentUserId = session()->get('user_id');
        $newRole = $this->request->getPost('role');

        // Admin tidak boleh mengubah role akunnya sendiri
        if (
            (int) $id === (int) $currentUserId &&
            $newRole !== $user['role']
        ) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Kamu tidak dapat mengubah role akun sendiri.');
        }

        // Validasi input
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'email' => "required|valid_email|is_unique[users.email,id_user,$id]",
            'phone' => 'permit_empty|max_length[20]',
            'address' => 'permit_empty',
            'role' => 'required|in_list[customer,admin,operator]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // Mencegah perubahan role admin terakhir
        if (
            $user['role'] === 'admin' &&
            $newRole !== 'admin'
        ) {
            $totalAdmins = $this->userModel
                ->where('role', 'admin')
                ->countAllResults();

            if ($totalAdmins <= 1) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Tidak dapat mengubah role admin terakhir.');
            }
        }

        // Update data pengguna
        $updated = $this->userModel->update($id, [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
            'role' => $newRole
        ]);

        if (!$updated) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data pengguna.');
        }

        return redirect()->to('/admin/users')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }


    // ==========================================
    // MENGHAPUS PENGGUNA
    // ==========================================
    public function delete($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('/admin/users')
                ->with('error', 'Pengguna tidak ditemukan.');
        }

        $currentUserId = session()->get('user_id');

        // Mencegah penghapusan akun sendiri
        if ((int) $id === (int) $currentUserId) {
            return redirect()->to('/admin/users')
                ->with('error', 'Kamu tidak dapat menghapus akun sendiri.');
        }

        // Mencegah penghapusan admin terakhir
        if ($user['role'] === 'admin') {
            $totalAdmins = $this->userModel
                ->where('role', 'admin')
                ->countAllResults();

            if ($totalAdmins <= 1) {
                return redirect()->to('/admin/users')
                    ->with('error', 'Admin terakhir tidak dapat dihapus.');
            }
        }

        $deleted = $this->userModel->delete($id);

        if (!$deleted) {
            return redirect()->to('/admin/users')
                ->with('error', 'Gagal menghapus pengguna.');
        }

        return redirect()->to('/admin/users')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
