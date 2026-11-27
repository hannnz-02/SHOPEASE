<?php

namespace App\Controllers\Admin;
use App\Models\ProductImageModel;
use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\CategoryModel;

class ProductController extends BaseController
{
    protected $productModel;
    protected $categoryModel;
    protected $imageModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->imageModel = new ProductImageModel();
    }

    // Menampilkan produk dengan Search, Filter, dan Pagination
    
// Menampilkan produk dengan Search, Filter, Pagination, dan Inventory
    public function index()
    {
        // Input pencarian dan filter
        $keyword = trim($this->request->getGet('keyword') ?? '');
        $categoryId = $this->request->getGet('category') ?? '';
        $stockStatus = $this->request->getGet('stock_status') ?? '';

        // Query dasar
        $builder = $this->productModel
            ->select('products.*, categories.category_name')
            ->join(
                'categories',
                'categories.id_category = products.id_category'
            );

        // Search nama produk
        if ($keyword !== '') {
            $builder->like('products.product_name', $keyword);
        }

        // Filter kategori
        if ($categoryId !== '' && ctype_digit((string) $categoryId)) {
            $builder->where('products.id_category', (int) $categoryId);
        } else {
            $categoryId = '';
        }

        // Filter status stok
        if ($stockStatus === 'low') {
            // Stok rendah: 1 sampai 5
            $builder->where('products.stock >', 0);
            $builder->where('products.stock <=', 5);

        } elseif ($stockStatus === 'out') {
            // Stok habis: 0
            $builder->where('products.stock', 0);

        } else {
            $stockStatus = '';
        }

        // Urutkan produk terbaru
        $builder->orderBy('products.id_product', 'DESC');

        // Pagination
        $products = $builder->paginate(10, 'products');

        return view('admin/products/index', [
            'title' => 'Product Management',
            'products' => $products,
            'categories' => $this->categoryModel->findAll(),
            'keyword' => $keyword,
            'selectedCategory' => $categoryId,
            'selectedStockStatus' => $stockStatus,
            'pager' => $this->productModel->pager
        ]);
    }



    // Form tambah produk
    public function create()
    {
        $categories = $this->categoryModel->findAll();

        if (empty($categories)) {
            return redirect()->to('/admin/categories')
                ->with('error', 'Tambahkan kategori terlebih dahulu.');
        }

        return view('admin/products/create', [
            'title' => 'Add Product',
            'categories' => $categories
        ]);
    }
    
    public function store()
    {
        // Validasi data produk dan gambar utama
        $rules = [
            'product_name' => 'required|min_length[3]|max_length[150]',
            'id_category' => 'required|is_natural_no_zero',
            'description' => 'permit_empty',
            'price' => 'required|decimal|greater_than_equal_to[0]',
            'stock' => 'required|integer|greater_than_equal_to[0]',
            'image' => 'uploaded[image]|is_image[image]|max_size[image,2048]|ext_in[image,jpg,jpeg,jpe,jfif,png,webp,gif]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // Periksa kategori
        $category = $this->categoryModel->find(
            $this->request->getPost('id_category')
        );

        if (!$category) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Kategori tidak ditemukan.');
        }

        // Ambil gambar utama dan gambar tambahan
        $primaryFile = $this->request->getFile('image');
        $additionalFiles = $this->getAdditionalImageFiles();

        // Validasi gambar utama
        if (!$this->isAllowedImageFile($primaryFile)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gambar utama tidak valid.');
        }

        // Validasi seluruh gambar tambahan
        foreach ($additionalFiles as $file) {
            if (!$this->isAllowedImageFile($file)) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Ada gambar tambahan yang tidak valid. Periksa format dan ukuran file.');
            }
        }

        // Siapkan folder upload
        $uploadPath = FCPATH . 'uploads/products/';

        if (!is_dir($uploadPath)) {
            if (!mkdir($uploadPath, 0755, true) && !is_dir($uploadPath)) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Folder upload tidak dapat dibuat.');
            }
        }

        // Gabungkan gambar utama dan tambahan
        $allFiles = array_merge(
            [$primaryFile],
            $additionalFiles
        );

        $savedFiles = [];

        // Upload seluruh gambar
        foreach ($allFiles as $file) {
            $imageName = $file->getRandomName();

            if (!$file->move($uploadPath, $imageName)) {
                $this->removeUploadedFiles($savedFiles, $uploadPath);

                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Gagal mengunggah gambar produk.');
            }

            $savedFiles[] = $imageName;
        }

        // Mulai transaksi database
        $db = db_connect();
        $db->transBegin();

        // Simpan data produk
        $data = [
            'id_category' => $category['id_category'],
            'product_name' => $this->request->getPost('product_name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'stock' => (int) $this->request->getPost('stock'),
            'image' => $savedFiles[0]
        ];

        $inserted = $this->productModel->insert($data);

        if ($inserted === false) {
            $db->transRollback();
            $this->removeUploadedFiles($savedFiles, $uploadPath);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan produk: ' .
                    implode(', ', $this->productModel->errors()));
        }

        $productId = $this->productModel->getInsertID();

        // Simpan seluruh gambar ke tabel product_images
        foreach ($savedFiles as $index => $imageName) {

            $imageInserted = $this->imageModel->insert([
                'id_product' => $productId,
                'image' => $imageName,
                'is_primary' => ($index === 0) ? 1 : 0,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            if ($imageInserted === false) {
                $db->transRollback();
                $this->removeUploadedFiles($savedFiles, $uploadPath);

                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Gagal menyimpan gambar ke Gallery.');
            }
        }

        // Periksa transaksi
        if (!$db->transStatus()) {
            $db->transRollback();
            $this->removeUploadedFiles($savedFiles, $uploadPath);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan produk dan gambar.');
        }

        // Simpan transaksi
        $db->transCommit();

        return redirect()->to('/admin/products')
            ->with('success', 'Produk dan seluruh gambar berhasil ditambahkan.');
    }

    // Menyimpan produk baru
        public function edit($id)
    {
        $product = $this->productModel->find($id);

        if (!$product) {
            return redirect()->to('/admin/products')
                ->with('error', 'Produk tidak ditemukan.');
        }

        // Mengambil seluruh gambar produk
        $images = $this->imageModel
            ->where('id_product', $id)
            ->orderBy('is_primary', 'DESC')
            ->orderBy('id_image', 'ASC')
            ->findAll();

        // Memastikan gambar lama tercatat di gallery
        if (
            !empty($product['image']) &&
            !in_array(
                $product['image'],
                array_column($images, 'image'),
                true
            )
        ) {
            $this->imageModel->insert([
                'id_product' => $id,
                'image' => $product['image'],
                'is_primary' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            // Ambil ulang gambar setelah disimpan
            $images = $this->imageModel
                ->where('id_product', $id)
                ->orderBy('is_primary', 'DESC')
                ->orderBy('id_image', 'ASC')
                ->findAll();
        }

        return view('admin/products/edit', [
            'title' => 'Edit Product',
            'product' => $product,
            'categories' => $this->categoryModel->findAll(),
            'images' => $images
        ]);
    }

    // Memperbarui produk

    public function update($id)
    {
        // Cari produk
        $product = $this->productModel->find($id);

        if (!$product) {
            return redirect()->to('/admin/products')
                ->with('error', 'Produk tidak ditemukan.');
        }

        // Validasi data produk
        $rules = [
            'product_name' => 'required|min_length[3]|max_length[150]',
            'id_category' => 'required|is_natural_no_zero',
            'description' => 'permit_empty',
            'price' => 'required|decimal|greater_than_equal_to[0]',
            'stock' => 'required|integer|greater_than_equal_to[0]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // Periksa kategori
        $category = $this->categoryModel->find(
            $this->request->getPost('id_category')
        );

        if (!$category) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Kategori tidak ditemukan.');
        }

        // Ambil gambar utama baru jika ada
        $primaryFile = $this->request->getFile('image');

        $hasNewPrimary = $primaryFile
            && $primaryFile->getError() !== UPLOAD_ERR_NO_FILE;

        // Ambil gambar tambahan
        $additionalFiles = $this->getAdditionalImageFiles();

        // Validasi gambar utama baru
        if ($hasNewPrimary && !$this->isAllowedImageFile($primaryFile)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gambar utama tidak valid.');
        }

        // Validasi gambar tambahan
        foreach ($additionalFiles as $file) {
            if (!$this->isAllowedImageFile($file)) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Ada gambar tambahan yang tidak valid.');
            }
        }

        // Siapkan folder upload
        $uploadPath = FCPATH . 'uploads/products/';

        if (!is_dir($uploadPath)) {
            if (!mkdir($uploadPath, 0755, true) && !is_dir($uploadPath)) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Folder upload tidak dapat dibuat.');
            }
        }

        // Gabungkan file yang akan di-upload
        $filesToUpload = [];

        if ($hasNewPrimary) {
            $filesToUpload[] = $primaryFile;
        }

        $filesToUpload = array_merge(
            $filesToUpload,
            $additionalFiles
        );

        $savedFiles = [];

        // Upload gambar baru
        foreach ($filesToUpload as $file) {
            $imageName = $file->getRandomName();

            if (!$file->move($uploadPath, $imageName)) {
                $this->removeUploadedFiles($savedFiles, $uploadPath);

                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Gagal mengunggah gambar.');
            }

            $savedFiles[] = $imageName;
        }

        // Tentukan gambar utama
        $newPrimaryImage = $hasNewPrimary
            ? $savedFiles[0]
            : $product['image'];

        // Mulai transaksi database
        $db = db_connect();
        $db->transBegin();

        // Cari gambar utama lama di gallery
        $oldPrimaryRecord = null;

        if (!empty($product['image'])) {
            $oldPrimaryRecord = $this->imageModel
                ->where('id_product', $id)
                ->where('image', $product['image'])
                ->first();
        }

        // Pastikan gambar utama lama tetap tersimpan di gallery
        if (!$oldPrimaryRecord && !empty($product['image'])) {
            $insertOld = $this->imageModel->insert([
                'id_product' => $id,
                'image' => $product['image'],
                'is_primary' => $hasNewPrimary ? 0 : 1,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            if ($insertOld === false) {
                $db->transRollback();
                $this->removeUploadedFiles($savedFiles, $uploadPath);

                return redirect()->back()
                    ->with('error', 'Gagal menyimpan gambar lama ke gallery.');
            }

            $oldPrimaryId = $this->imageModel->getInsertID();
        } else {
            $oldPrimaryId = $oldPrimaryRecord['id_image'] ?? null;
        }

        // Jika gambar utama diganti
        if ($hasNewPrimary) {

            // Jadikan seluruh gambar lama bukan gambar utama
            $this->imageModel
                ->where('id_product', $id)
                ->set(['is_primary' => 0])
                ->update();

            // Simpan gambar utama baru
            $insertPrimary = $this->imageModel->insert([
                'id_product' => $id,
                'image' => $newPrimaryImage,
                'is_primary' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            if ($insertPrimary === false) {
                $db->transRollback();
                $this->removeUploadedFiles($savedFiles, $uploadPath);

                return redirect()->back()
                    ->with('error', 'Gagal memperbarui gambar utama.');
            }

        } else {

            // Pertahankan gambar utama yang sekarang
            if ($oldPrimaryId) {
                $this->imageModel
                    ->where('id_product', $id)
                    ->set(['is_primary' => 0])
                    ->update();

                $this->imageModel->update($oldPrimaryId, [
                    'is_primary' => 1
                ]);
            }
        }

        // Simpan gambar tambahan
        $additionalStart = $hasNewPrimary ? 1 : 0;

        for ($i = $additionalStart; $i < count($savedFiles); $i++) {

            $insertAdditional = $this->imageModel->insert([
                'id_product' => $id,
                'image' => $savedFiles[$i],
                'is_primary' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            if ($insertAdditional === false) {
                $db->transRollback();
                $this->removeUploadedFiles($savedFiles, $uploadPath);

                return redirect()->back()
                    ->with('error', 'Gagal menyimpan gambar tambahan.');
            }
        }

        // Perbarui data produk
        $data = [
            'id_category' => $category['id_category'],
            'product_name' => $this->request->getPost('product_name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'stock' => (int) $this->request->getPost('stock'),
            'image' => $newPrimaryImage
        ];

        $updated = $this->productModel->update($id, $data);

        // Periksa transaksi
        if ($updated === false || !$db->transStatus()) {
            $db->transRollback();
            $this->removeUploadedFiles($savedFiles, $uploadPath);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui produk dan gallery.');
        }

        // Simpan transaksi
        $db->transCommit();

        return redirect()->to('/admin/products/edit/' . $id)
            ->with('success', 'Produk dan gallery berhasil diperbarui.');
    }

        // Menghapus produk
    
// Menghapus produk beserta seluruh gambar Gallery
    public function delete($id)
    {
        // Cari produk
        $product = $this->productModel->find($id);

        if (!$product) {
            return redirect()->to('/admin/products')
                ->with('error', 'Produk tidak ditemukan.');
        }

        // Ambil seluruh gambar dari Gallery
        $images = $this->imageModel
            ->where('id_product', $id)
            ->findAll();

        // Kumpulkan nama file gambar
        $imageNames = array_column($images, 'image');

        // Sertakan gambar utama lama jika belum masuk Gallery
        if (!empty($product['image'])) {
            $imageNames[] = $product['image'];
        }

        // Hindari nama file duplikat
        $imageNames = array_unique($imageNames);

        // Mulai transaksi database
        $db = db_connect();
        $db->transBegin();

        // Hapus produk
        // Data product_images ikut terhapus melalui ON DELETE CASCADE
        $deleted = $this->productModel->delete($id);

        if ($deleted === false || !$db->transStatus()) {
            $db->transRollback();

            return redirect()->to('/admin/products')
                ->with('error', 'Gagal menghapus produk.');
        }

        // Selesaikan transaksi database
        $db->transCommit();

        // Hapus seluruh file gambar dari folder
        $uploadPath = FCPATH . 'uploads/products/';

        foreach ($imageNames as $imageName) {
            $imagePath = $uploadPath . $imageName;

            if (is_file($imagePath)) {
                unlink($imagePath);
            }
        }

        return redirect()->to('/admin/products')
            ->with('success', 'Produk dan seluruh gambar berhasil dihapus.');
    }


    // Mengatur gambar utama produk
    public function setPrimaryImage($id, $imageId)
    {
        $product = $this->productModel->find($id);

        $image = $this->imageModel
            ->where('id_image', $imageId)
            ->where('id_product', $id)
            ->first();

        if (!$product || !$image) {
            return redirect()->back()
                ->with('error', 'Gambar tidak ditemukan.');
        }

        $db = db_connect();
        $db->transBegin();

        // Jadikan semua gambar bukan gambar utama
        $reset = $db->table('product_images')
            ->where('id_product', $id)
            ->update(['is_primary' => 0]);

        // Jadikan gambar pilihan sebagai gambar utama
        $selected = $db->table('product_images')
            ->where('id_image', $imageId)
            ->where('id_product', $id)
            ->update(['is_primary' => 1]);

        // Sinkronkan gambar utama pada tabel products
        $updated = $this->productModel->update($id, [
            'image' => $image['image']
        ]);

        if (
            $reset === false ||
            $selected === false ||
            $updated === false ||
            !$db->transStatus()
        ) {
            $db->transRollback();

            return redirect()->back()
                ->with('error', 'Gagal mengganti gambar utama.');
        }

        $db->transCommit();

        return redirect()->to('/admin/products/edit/' . $id)
            ->with('success', 'Gambar utama berhasil diganti.');
    }

    // Menghapus gambar tertentu dari gallery
    public function deleteImage($id, $imageId)
    {
        $product = $this->productModel->find($id);

        $image = $this->imageModel
            ->where('id_image', $imageId)
            ->where('id_product', $id)
            ->first();

        if (!$product || !$image) {
            return redirect()->back()
                ->with('error', 'Gambar tidak ditemukan.');
        }

        // Ambil seluruh gambar produk
        $images = $this->imageModel
            ->where('id_product', $id)
            ->orderBy('is_primary', 'DESC')
            ->orderBy('id_image', 'ASC')
            ->findAll();

        // Minimal harus ada satu gambar
        if (count($images) <= 1) {
            return redirect()->back()
                ->with('error', 'Minimal satu gambar harus tersedia.');
        }

        // Periksa apakah gambar yang dihapus merupakan gambar utama
        $isPrimary = (
            (int) $image['is_primary'] === 1 ||
            $product['image'] === $image['image']
        );

        // Mulai transaksi
        $db = db_connect();
        $db->transBegin();

        if ($isPrimary) {

            // Cari gambar pengganti
            $remainingImages = array_values(array_filter(
                $images,
                function ($item) use ($imageId) {
                    return (int) $item['id_image'] !== (int) $imageId;
                }
            ));

            $newPrimary = $remainingImages[0];

            // Reset semua gambar
            $reset = $db->table('product_images')
                ->where('id_product', $id)
                ->update(['is_primary' => 0]);

            // Tentukan gambar pengganti sebagai utama
            $setPrimary = $db->table('product_images')
                ->where('id_image', $newPrimary['id_image'])
                ->where('id_product', $id)
                ->update(['is_primary' => 1]);

            // Perbarui kolom gambar utama produk
            $updateProduct = $this->productModel->update($id, [
                'image' => $newPrimary['image']
            ]);

            if (
                $reset === false ||
                $setPrimary === false ||
                $updateProduct === false
            ) {
                $db->transRollback();

                return redirect()->back()
                    ->with('error', 'Gagal mengganti gambar utama.');
            }
        }

        // Hapus record gambar dari database
        $deleted = $this->imageModel->delete($imageId);

        if ($deleted === false || !$db->transStatus()) {
            $db->transRollback();

            return redirect()->back()
                ->with('error', 'Gagal menghapus gambar.');
        }

        $db->transCommit();

        // Hapus file fisik setelah transaksi berhasil
        $imagePath = FCPATH . 'uploads/products/' . $image['image'];

        if (is_file($imagePath)) {
            unlink($imagePath);
        }

        return redirect()->to('/admin/products/edit/' . $id)
            ->with('success', 'Gambar berhasil dihapus.');
    }


    // Mengambil gambar tambahan dari form
    private function getAdditionalImageFiles(): array
    {
        $files = $this->request->getFileMultiple('images') ?? [];

        return array_values(array_filter($files, function ($file) {
            return $file
                && $file->getError() !== UPLOAD_ERR_NO_FILE;
        }));
    }


    // Memvalidasi gambar
    private function isAllowedImageFile($file): bool
    {
        if (!$file || !$file->isValid() || $file->hasMoved()) {
            return false;
        }

        $allowedExtensions = [
            'jpg', 'jpeg', 'jpe', 'jfif',
            'png', 'webp', 'gif'
        ];

        $allowedMimes = [
            'image/jpeg',
            'image/pjpeg',
            'image/png',
            'image/webp',
            'image/gif'
        ];

        $extension = strtolower($file->getClientExtension());
        $mime = $file->getMimeType();

        if (!in_array($extension, $allowedExtensions, true)) {
            return false;
        }

        if (!in_array($mime, $allowedMimes, true)) {
            return false;
        }

        if ($file->getSize() > 2 * 1024 * 1024) {
            return false;
        }

        $imageInfo = @getimagesize($file->getTempName());

        return $imageInfo !== false
            && in_array($imageInfo['mime'], $allowedMimes, true);
    }


    // Menghapus file jika proses upload gagal
    private function removeUploadedFiles(
        array $files,
        string $uploadPath
    ): void {
        foreach ($files as $file) {
            $path = $uploadPath . $file;

            if (is_file($path)) {
                unlink($path);
            }
        }
    }
}
