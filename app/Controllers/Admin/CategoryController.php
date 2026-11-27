<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class CategoryController extends BaseController
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    // Menampilkan semua kategori
    public function index()
    {
        $data = [
            'title' => 'Category Management',
            'categories' => $this->categoryModel->findAll()
        ];

        return view('admin/categories/index', $data);
    }

    // Menampilkan form tambah kategori
    public function create()
    {
        return view('admin/categories/create', [
            'title' => 'Add Category'
        ]);
    }

    // Menyimpan kategori baru
    public function store()
    {
        $rules = [
            'category_name' => 'required|min_length[3]|max_length[100]',
            'description' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->categoryModel->save([
            'category_name' => $this->request->getPost('category_name'),
            'description' => $this->request->getPost('description')
        ]);

        return redirect()->to('/admin/categories')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Menampilkan form edit kategori
    public function edit($id)
    {
        $category = $this->categoryModel->find($id);

        if (!$category) {
            return redirect()->to('/admin/categories')
                ->with('error', 'Kategori tidak ditemukan.');
        }

        return view('admin/categories/edit', [
            'title' => 'Edit Category',
            'category' => $category
        ]);
    }

    // Memperbarui kategori
    public function update($id)
    {
        $category = $this->categoryModel->find($id);

        if (!$category) {
            return redirect()->to('/admin/categories')
                ->with('error', 'Kategori tidak ditemukan.');
        }

        $rules = [
            'category_name' => 'required|min_length[3]|max_length[100]',
            'description' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->categoryModel->update($id, [
            'category_name' => $this->request->getPost('category_name'),
            'description' => $this->request->getPost('description')
        ]);

        return redirect()->to('/admin/categories')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    // Menghapus kategori
    public function delete($id)
    {
        $category = $this->categoryModel->find($id);

        if (!$category) {
            return redirect()->to('/admin/categories')
                ->with('error', 'Kategori tidak ditemukan.');
        }

        if ($this->categoryModel->delete($id)) {
            return redirect()->to('/admin/categories')
                ->with('success', 'Kategori berhasil dihapus.');
        }

        return redirect()->to('/admin/categories')
            ->with('error', 'Kategori gagal dihapus.');
    }
}
