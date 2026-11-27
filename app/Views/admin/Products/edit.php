
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Product | ShopEase</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary: #17645F;
            --primary-light: #E5F3F0;
            --dark: #183D3A;
            --muted: #82918F;
            --background: #F5F8F7;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--background);
            font-family: Arial, sans-serif;
            color: var(--dark);
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: white;
            border-right: 1px solid #E8EFED;
            padding: 25px 18px;
            z-index: 100;
        }

        .brand {
            font-size: 23px;
            font-weight: 800;
            color: var(--primary);
            padding: 5px 12px 35px;
        }

        .brand i {
            margin-right: 8px;
        }

        .menu-label {
            font-size: 11px;
            color: #A0AEAB;
            font-weight: bold;
            letter-spacing: 1px;
            padding: 0 12px;
            margin: 18px 0 10px;
        }

        .nav-link {
            display: block;
            color: #687A76;
            padding: 12px 14px;
            border-radius: 9px;
            margin-bottom: 6px;
            font-size: 14px;
            text-decoration: none;
            transition: 0.2s;
        }

        .nav-link i {
            margin-right: 12px;
            font-size: 17px;
        }

        .nav-link.active,
        .nav-link:hover {
            background: var(--primary-light);
            color: var(--primary);
            font-weight: 600;
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 250px;
            padding: 25px 35px;
            min-height: 100vh;
        }

        /* TOPBAR */
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: white;
            padding: 15px 22px;
            border-radius: 13px;
            margin-bottom: 32px;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .avatar {
            width: 39px;
            height: 39px;
            background: var(--primary-light);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        /* PAGE TITLE */
        .page-title h2 {
            font-size: 27px;
            font-weight: 750;
            color: var(--dark);
        }

        .page-title p {
            color: var(--muted);
            margin-top: 7px;
            font-size: 14px;
        }

        /* CONTENT CARD */
        .content-card {
            background: white;
            border: 1px solid #EDF1F0;
            border-radius: 14px;
            padding: 28px;
            max-width: 950px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 7px;
        }

        .section-description {
            color: var(--muted);
            font-size: 13px;
            margin-bottom: 28px;
        }

        /* FORM */
        .form-label {
            color: #344C48;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            border: 1px solid #DCE6E3;
            border-radius: 9px;
            padding: 11px 13px;
            font-size: 13px;
            color: #344C48;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(23, 100, 95, 0.1);
        }

        textarea.form-control {
            min-height: 110px;
            resize: vertical;
        }

        .form-text {
            font-size: 11px;
            color: var(--muted);
        }

        /* IMAGE PREVIEW */
        .image-preview {
            width: 150px;
            height: 150px;
            border: 2px dashed #DCE6E3;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: #FAFCFB;
            margin-top: 12px;
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .image-placeholder {
            text-align: center;
            color: var(--muted);
            font-size: 12px;
        }

        .image-placeholder i {
            display: block;
            font-size: 30px;
            margin-bottom: 7px;
        }

        .additional-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 12px;
        }

        .additional-preview img {
            width: 90px;
            height: 90px;
            object-fit: contain;
            border: 1px solid #DCE6E3;
            border-radius: 9px;
            padding: 5px;
            background: #FAFCFB;
        }

        /* GALLERY */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
            gap: 16px;
        }

        .gallery-item {
            border: 1px solid #E8EFED;
            border-radius: 12px;
            padding: 12px;
            background: white;
            min-width: 0;
        }

        .gallery-image {
            height: 155px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #F5F8F7;
            border-radius: 9px;
            margin-bottom: 12px;
            overflow: hidden;
        }

        .gallery-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 8px;
        }

        .gallery-badge {
            display: inline-block;
            font-size: 11px;
            padding: 6px 10px;
            border-radius: 20px;
            background: var(--primary-light);
            color: var(--primary);
            font-weight: 600;
        }

        .gallery-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
            margin-top: 12px;
        }

        .btn-gallery {
            border: 1px solid #DCE6E3;
            background: white;
            color: #657572;
            border-radius: 7px;
            padding: 7px 9px;
            font-size: 11px;
        }

        .btn-gallery:hover {
            background: var(--primary-light);
            color: var(--primary);
            border-color: var(--primary-light);
        }

        .btn-gallery-delete {
            border: 1px solid #F1D8D6;
            background: white;
            color: #C65A51;
            border-radius: 7px;
            padding: 7px 9px;
            font-size: 11px;
        }

        .btn-gallery-delete:hover {
            background: #FFF0EF;
            color: #C0392B;
        }

        .btn-gallery-delete:disabled {
            opacity: 0.45;
            cursor: not-allowed;
        }

        /* BUTTONS */
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 30px;
            padding-top: 22px;
            border-top: 1px solid #E8EFED;
        }

        .btn-cancel {
            background: white;
            color: #657572;
            border: 1px solid #DCE6E3;
            border-radius: 9px;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 13px;
        }

        .btn-cancel:hover {
            background: #F5F8F7;
            color: var(--primary);
        }

        .btn-save {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 9px;
            padding: 10px 20px;
            font-size: 13px;
        }

        .btn-save:hover {
            background: #124F4B;
            color: white;
        }

        /* FOOTER */
        .footer {
            color: #A0AEAB;
            font-size: 12px;
            text-align: center;
            padding: 35px 0 10px;
        }

        /* RESPONSIVE */
        @media(max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main-content {
                margin-left: 0;
                padding: 20px 15px;
            }
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<aside class="sidebar">

    <div class="brand">
        <i class="bi bi-bag-check-fill"></i> ShopEase.
    </div>

    <div class="menu-label">MAIN MENU</div>

    <a href="<?= site_url('admin') ?>" class="nav-link">
        <i class="bi bi-grid"></i> Dashboard
    </a>

    <div class="menu-label">MANAGEMENT</div>

    <a href="<?= site_url('admin/products') ?>" class="nav-link active">
        <i class="bi bi-box-seam"></i> Products
    </a>

    <a href="<?= site_url('admin/categories') ?>" class="nav-link">
        <i class="bi bi-tags"></i> Categories
    </a>

    <a href="<?= site_url('admin/users') ?>" class="nav-link">
        <i class="bi bi-people"></i> Users
    </a>

    <div class="menu-label">ACCOUNT</div>

    <form action="<?= site_url('logout') ?>" method="POST">
        <?= csrf_field() ?>

        <button type="submit"
                class="nav-link w-100 text-start border-0 bg-transparent">
            <i class="bi bi-box-arrow-right"></i> Logout
        </button>
    </form>

</aside>


<!-- MAIN CONTENT -->
<main class="main-content">

    <!-- TOPBAR -->
    <div class="topbar">

        <div class="fw-semibold">
            Product Management
        </div>

        <div class="admin-profile">

            <div class="text-end d-none d-sm-block">
                <div class="fw-bold small">
                    <?= esc(session()->get('name')) ?>
                </div>

                <small class="text-secondary">
                    Administrator
                </small>
            </div>

            <div class="avatar">
                <i class="bi bi-person-fill"></i>
            </div>

        </div>

    </div>


    <!-- PAGE TITLE -->
    <section class="page-title mb-4">

        <h2>Edit Product</h2>

        <p>
            Update product information and manage product images.
        </p>

    </section>


    <!-- FLASH MESSAGE -->
    <?php if (session()->getFlashdata('success')): ?>

        <div class="alert alert-success alert-dismissible fade show small">

            <?= esc(session()->getFlashdata('success')) ?>

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    <?php endif; ?>


    <?php if (session()->getFlashdata('error')): ?>

        <div class="alert alert-danger alert-dismissible fade show small">

            <?= esc(session()->getFlashdata('error')) ?>

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    <?php endif; ?>


    <?php if (session()->getFlashdata('errors')): ?>

        <div class="alert alert-danger small">

            <strong>Please check the following:</strong>

            <ul class="mb-0 mt-2">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>

        </div>

    <?php endif; ?>


    <!-- EDIT PRODUCT FORM -->
    <div class="content-card">

        <h5 class="section-title">
            Product Information
        </h5>

        <p class="section-description">
            Update the information below to edit your product.
        </p>


        <form action="<?= site_url('admin/products/update/' . $product['id_product']) ?>"
              method="POST"
              enctype="multipart/form-data">

            <?= csrf_field() ?>


            <!-- PRODUCT NAME -->
            <div class="mb-4">

                <label class="form-label">
                    Product Name *
                </label>

                <input type="text"
                       name="product_name"
                       class="form-control"
                       value="<?= esc(old('product_name', $product['product_name'])) ?>"
                       required>

            </div>


            <!-- CATEGORY -->
            <div class="mb-4">

                <label class="form-label">
                    Category *
                </label>

                <select name="id_category"
                        class="form-select"
                        required>

                    <option value="">
                        Select Category
                    </option>

                    <?php foreach ($categories as $category): ?>

                        <option value="<?= esc($category['id_category']) ?>"
                            <?= old('id_category', $product['id_category']) == $category['id_category'] ? 'selected' : '' ?>>

                            <?= esc($category['category_name']) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>


            <!-- DESCRIPTION -->
            <div class="mb-4">

                <label class="form-label">
                    Description
                </label>

                <textarea name="description"
                          class="form-control"
                          placeholder="Enter product description..."><?= esc(old('description', $product['description'] ?? '')) ?></textarea>

            </div>


            <!-- PRICE AND STOCK -->
            <div class="row">

                <div class="col-md-6 mb-4">

                    <label class="form-label">
                        Price (Rp) *
                    </label>

                    <input type="number"
                           name="price"
                           class="form-control"
                           min="0"
                           step="0.01"
                           value="<?= esc(old('price', $product['price'])) ?>"
                           required>

                </div>


                <div class="col-md-6 mb-4">

                    <label class="form-label">
                        Stock *
                    </label>

                    <input type="number"
                           name="stock"
                           class="form-control"
                           min="0"
                           step="1"
                           value="<?= esc(old('stock', $product['stock'])) ?>"
                           required>

                </div>

            </div>


            <!-- CHANGE MAIN IMAGE -->
            <div class="mb-4">

                <label class="form-label">
                    Change Main Product Image
                </label>

                <input type="file"
                       name="image"
                       id="image"
                       class="form-control"
                       accept=".jpg,.jpeg,.jpe,.png,.webp,.gif,.jfif">

                <div class="form-text">
                    Leave empty to keep the current main image.
                    Maximum 2 MB.
                </div>


                <!-- CURRENT MAIN IMAGE PREVIEW -->
                <div class="image-preview" id="imagePreview">

                    <?php if (
                        !empty($product['image']) &&
                        is_file(FCPATH . 'uploads/products/' . $product['image'])
                    ): ?>

                        <img
                            src="<?= base_url('uploads/products/' . rawurlencode($product['image'])) ?>"
                            alt="Current Main Product Image">

                    <?php else: ?>

                        <div class="image-placeholder">
                            <i class="bi bi-image"></i>
                            No Main Image
                        </div>

                    <?php endif; ?>

                </div>

            </div>


            <!-- ADDITIONAL IMAGES -->
            <div class="mb-4">

                <label class="form-label">
                    Add More Product Images
                </label>

                <input type="file"
                       name="images[]"
                       id="additionalImages"
                       class="form-control"
                       accept=".jpg,.jpeg,.jpe,.png,.webp,.gif,.jfif"
                       multiple>

                <div class="form-text">
                    Select multiple additional images.
                    Maximum 2 MB per image.
                </div>

                <div class="additional-preview" id="additionalPreview"></div>

            </div>


            <!-- FORM ACTIONS -->
            <div class="form-actions">

                <a href="<?= site_url('admin/products') ?>"
                   class="btn-cancel">
                    Cancel
                </a>

                <button type="submit" class="btn-save">
                    <i class="bi bi-check-lg me-1"></i>
                    Update Product
                </button>

            </div>

        </form>

    </div>


    <!-- PRODUCT IMAGE GALLERY -->
    <div class="content-card mt-4">

        <h5 class="section-title">
            Product Image Gallery
        </h5>

        <p class="section-description">
            View, select, and delete images belonging to this product.
        </p>


        <?php if (!empty($images)): ?>

            <div class="gallery-grid">

                <?php foreach ($images as $image): ?>

                    <?php
                        $isPrimary = (
                            (int) $image['is_primary'] === 1 ||
                            $product['image'] === $image['image']
                        );

                        $imageExists = is_file(
                            FCPATH . 'uploads/products/' . $image['image']
                        );
                    ?>

                    <div class="gallery-item">

                        <!-- IMAGE -->
                        <div class="gallery-image">

                            <?php if ($imageExists): ?>

                                <img
                                    src="<?= base_url('uploads/products/' . rawurlencode($image['image'])) ?>"
                                    alt="Product Image">

                            <?php else: ?>

                                <div class="image-placeholder">
                                    <i class="bi bi-image"></i>
                                    Image not found
                                </div>

                            <?php endif; ?>

                        </div>


                        <!-- IMAGE STATUS -->
                        <?php if ($isPrimary): ?>

                            <span class="gallery-badge">
                                <i class="bi bi-star-fill me-1"></i>
                                Main Image
                            </span>

                        <?php else: ?>

                            <span class="badge bg-light text-secondary">
                                Additional Image
                            </span>

                        <?php endif; ?>


                        <!-- IMAGE ACTIONS -->
                        <div class="gallery-actions">

                            <?php if (!$isPrimary): ?>

                                <form
                                    action="<?= site_url('admin/products/' . $product['id_product'] . '/images/' . $image['id_image'] . '/primary') ?>"
                                    method="POST">

                                    <?= csrf_field() ?>

                                    <button type="submit" class="btn-gallery">

                                        <i class="bi bi-star me-1"></i>
                                        Set Main

                                    </button>

                                </form>

                            <?php endif; ?>


                            <form
                                action="<?= site_url('admin/products/' . $product['id_product'] . '/images/' . $image['id_image'] . '/delete') ?>"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this image?')">

                                <?= csrf_field() ?>

                                <button type="submit"
                                        class="btn-gallery-delete"
                                        <?= count($images) <= 1 ? 'disabled title="At least one image must remain"' : '' ?>>

                                    <i class="bi bi-trash me-1"></i>
                                    Delete

                                </button>

                            </form>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php else: ?>

            <div class="text-center py-5">

                <i class="bi bi-images fs-1 text-secondary"></i>

                <p class="text-secondary mt-2 mb-1">
                    No images available.
                </p>

                <small class="text-secondary">
                    Add product images using the form above.
                </small>

            </div>

        <?php endif; ?>

    </div>


    <!-- FOOTER -->
    <div class="footer">
        © <?= date('Y') ?> ShopEase. All rights reserved.
    </div>

</main>


<!-- JAVASCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Preview gambar utama baru
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');

    imageInput.addEventListener('change', function () {

        const file = this.files[0];

        if (file) {

            const reader = new FileReader();

            reader.onload = function (e) {

                imagePreview.innerHTML = `
                    <img src="${e.target.result}" alt="New Main Product Image">
                `;

            };

            reader.onerror = function () {
                alert('Unable to preview this image.');
            };

            reader.readAsDataURL(file);

        }

    });


    // Preview beberapa gambar tambahan
    const additionalInput = document.getElementById('additionalImages');
    const additionalPreview = document.getElementById('additionalPreview');

    additionalInput.addEventListener('change', function () {

        additionalPreview.innerHTML = '';

        const files = Array.from(this.files);

        files.forEach(function (file) {

            if (!file.type.startsWith('image/')) {
                alert('Please select image files only.');
                return;
            }

            const reader = new FileReader();

            reader.onload = function (e) {

                const image = document.createElement('img');

                image.src = e.target.result;
                image.alt = 'Additional Product Image Preview';

                additionalPreview.appendChild(image);

            };

            reader.readAsDataURL(file);

        });

    });
</script>

</body>
</html>
