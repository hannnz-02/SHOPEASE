<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        // Statistik produk dan kategori
        $totalProducts = $db->table('products')->countAllResults();
        $totalCategories = $db->table('categories')->countAllResults();

        // Statistik pengguna
        $totalUsers = $db->table('users')->countAllResults();

        // Produk dengan stok tersedia
        $availableProducts = $db->table('products')
            ->where('stock >', 0)
            ->countAllResults();

        // Produk yang stoknya habis
        $unavailableProducts = $db->table('products')
            ->where('stock', 0)
            ->countAllResults();

        // Belum ada perhitungan transaksi
        $totalTransactions = 0;

        return view('admin/dashboard', [
            'title' => 'Admin Dashboard',
            'totalProducts' => $totalProducts,
            'totalCategories' => $totalCategories,
            'totalUsers' => $totalUsers,
            'availableProducts' => $availableProducts,
            'unavailableProducts' => $unavailableProducts,
            'totalTransactions' => $totalTransactions
        ]);
    }
}