
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Management | ShopEase</title>

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

        /* ================= SIDEBAR ================= */

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

        /* ================= MAIN CONTENT ================= */

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
        }

        .page-title p {
            color: var(--muted);
            margin-top: 7px;
        }

        /* CONTENT CARD */

        .content-card {
            background: white;
            border: 1px solid #EDF1F0;
            border-radius: 14px;
            padding: 24px;
        }

        /* ADD PRODUCT BUTTON */

        .btn-primary-custom {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 9px;
            padding: 10px 17px;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary-custom:hover {
            background: #124F4B;
            color: white;
        }

        /* SEARCH AND FILTER */

        .search-input,
        .filter-select {
            border: 1px solid #DCE6E3;
            border-radius: 9px;
            padding: 10px 13px;
            font-size: 13px;
            color: #344C48;
            background: white;
            width: 100%;
        }

        .search-input:focus,
        .filter-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(23, 100, 95, 0.1);
            outline: none;
        }

        .btn-filter {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 9px;
            padding: 10px 16px;
            font-size: 13px;
        }

        .btn-filter:hover {
            background: #124F4B;
            color: white;
        }

        .btn-reset {
            background: white;
            color: #657572;
            border: 1px solid #DCE6E3;
            border-radius: 9px;
            padding: 10px 13px;
            font-size: 13px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-reset:hover {
            background: var(--primary-light);
            color: var(--primary);
        }

        /* TABLE */

        .table thead th {
            background: #F5F8F7;
            color: #687A76;
            font-size: 13px;
            font-weight: 600;
            padding: 14px;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 14px;
            vertical-align: middle;
            font-size: 13px;
        }

        /* PRODUCT IMAGE */

        .product-image {
            width: 55px;
            height: 55px;
            object-fit: contain;
            border-radius: 9px;
            background: #F5F8F7;
            padding: 5px;
            flex-shrink: 0;
        }

        /* CATEGORY */

        .category-badge {
            background: var(--primary-light);
            color: var(--primary);
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        /* STOCK STATUS */

        .stock-number {
            color: var(--dark);
            font-weight: 600;
            font-size: 13px;
            display: block;
            margin-bottom: 6px;
        }

        .stock-status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
        }

        .stock-available {
            background: #E5F3F0;
            color: #17645F;
        }

        .stock-low {
            background: #FFF3CD;
            color: #856404;
        }

        .stock-out {
            background: #FFF0EF;
            color: #C0392B;
        }

        /* ACTION BUTTONS */

        .btn-edit {
            background: #EAF1FC;
            color: #4776BB;
        }

        .btn-delete {
            background: #FFF0EF;
            color: #C65A51;
        }

        .btn-edit,
        .btn-delete {
            border: none;
            border-radius: 7px;
            padding: 7px 11px;
        }

        .btn-edit:hover {
            background: #DCE9FA;
            color: #315F9D;
        }

        .btn-delete:hover {
            background: #FADDD9;
            color: #B83C33;
        }

        /* PAGINATION */

        .pagination {
            margin-bottom: 0;
            gap: 4px;
        }

        .pagination .page-link {
            border: 1px solid #DCE6E3;
            color: var(--primary);
            border-radius: 7px;
            font-size: 12px;
        }

        .pagination .page-item.active .page-link {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .pagination .page-item.disabled .page-link {
            color: #A0AEAB;
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

            .content-card {
                padding: 16px;
            }
        }
    </style>
</head>

<body>

<!-- ================= SIDEBAR ================= -->

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


<!-- ================= MAIN CONTENT ================= -->

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

        <h2>Products</h2>

        <p>
            Manage your electronic products, prices, and inventory.
        </p>

    </section>


    <!-- FLASH MESSAGE -->

    <?php if (session()->getFlashdata('success')): ?>

        <div class="alert alert-success alert-dismissible fade show">

            <?= esc(session()->getFlashdata('success')) ?>

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    <?php endif; ?>


    <?php if (session()->getFlashdata('error')): ?>

        <div class="alert alert-danger alert-dismissible fade show">

            <?= esc(session()->getFlashdata('error')) ?>

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    <?php endif; ?>


    <!-- PRODUCT TABLE CARD -->

    <div class="content-card">

        <!-- CARD HEADER -->

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

            <div>

                <h5 class="fw-bold mb-1">
                    Product List
                </h5>

                <small class="text-secondary">
                    Manage all products available in your store.
                </small>

            </div>

            <a href="<?= site_url('admin/products/create') ?>"
               class="btn-primary-custom">

                <i class="bi bi-plus-lg me-1"></i>
                Add Product

            </a>

        </div>


        <!-- SEARCH AND FILTER -->

        <form action="<?= site_url('admin/products') ?>"
              method="GET"
              class="mb-4">

            <div class="row g-2 align-items-center">

                <!-- SEARCH PRODUCT -->

                <div class="col-lg-4 col-md-6">

                    <input type="text"
                           name="keyword"
                           class="form-control search-input"
                           placeholder="Search product name..."
                           value="<?= esc($keyword ?? '') ?>">

                </div>


                <!-- CATEGORY FILTER -->

                <div class="col-lg-3 col-md-6">

                    <select name="category"
                            class="form-select filter-select">

                        <option value="">
                            All Categories
                        </option>

                        <?php foreach ($categories as $category): ?>

                            <option value="<?= esc($category['id_category']) ?>"
                                <?= ($selectedCategory ?? '') == $category['id_category'] ? 'selected' : '' ?>>

                                <?= esc($category['category_name']) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <!-- STOCK FILTER -->

                <div class="col-lg-3 col-md-6">

                    <select name="stock_status"
                            class="form-select filter-select">

                        <option value="">
                            All Stock Status
                        </option>

                        <option value="low"
                            <?= ($selectedStockStatus ?? '') === 'low' ? 'selected' : '' ?>>

                            Low Stock

                        </option>

                        <option value="out"
                            <?= ($selectedStockStatus ?? '') === 'out' ? 'selected' : '' ?>>

                            Out of Stock

                        </option>

                    </select>

                </div>


                <!-- FILTER BUTTONS -->

                <div class="col-lg-2 col-md-6 d-flex gap-2">

                    <button type="submit" class="btn-filter">

                        <i class="bi bi-search"></i>

                    </button>

                    <a href="<?= site_url('admin/products') ?>"
                       class="btn-reset">

                        Reset

                    </a>

                </div>

            </div>

        </form>


        <!-- PRODUCT TABLE -->

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>
                        <th>No.</th>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>

                </thead>


                <tbody>

                    <?php if (!empty($products)): ?>

                        <?php foreach ($products as $index => $product): ?>

                            <?php $stock = (int) $product['stock']; ?>

                            <tr>

                                <!-- NUMBER -->

                                <td>
                                    <?= (($pager->getCurrentPage('products') - 1) * 10) + $index + 1 ?>
                                </td>


                                <!-- PRODUCT INFORMATION -->

                                <td>

                                    <div class="d-flex align-items-center gap-2">

                                        <?php if (
                                            !empty($product['image']) &&
                                            is_file(FCPATH . 'uploads/products/' . $product['image'])
                                        ): ?>

                                            <img
                                                src="<?= base_url('uploads/products/' . rawurlencode($product['image'])) ?>"
                                                class="product-image"
                                                alt="<?= esc($product['product_name']) ?>">

                                        <?php else: ?>

                                            <div class="product-image d-flex align-items-center justify-content-center">

                                                <i class="bi bi-image text-secondary fs-4"></i>

                                            </div>

                                        <?php endif; ?>


                                        <div>

                                            <strong>
                                                <?= esc($product['product_name']) ?>
                                            </strong>

                                            <div class="text-secondary small">
                                                ID: <?= esc($product['id_product']) ?>
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                <!-- CATEGORY -->

                                <td>

                                    <span class="category-badge">
                                        <?= esc($product['category_name']) ?>
                                    </span>

                                </td>


                                <!-- PRICE -->

                                <td class="fw-semibold">

                                    Rp <?= number_format((float) $product['price'], 0, ',', '.') ?>

                                </td>


                                <!-- STOCK AND STATUS -->

                                <td>

                                    <span class="stock-number">
                                        <?= $stock ?> unit
                                    </span>

                                    <?php if ($stock <= 0): ?>

                                        <span class="stock-status stock-out">

                                            <i class="bi bi-x-circle me-1"></i>
                                            Out of Stock

                                        </span>

                                    <?php elseif ($stock <= 5): ?>

                                        <span class="stock-status stock-low">

                                            <i class="bi bi-exclamation-circle me-1"></i>
                                            Low Stock

                                        </span>

                                    <?php else: ?>

                                        <span class="stock-status stock-available">

                                            <i class="bi bi-check-circle me-1"></i>
                                            Available

                                        </span>

                                    <?php endif; ?>

                                </td>


                                <!-- ACTION -->

                                <td>

                                    <a href="<?= site_url('admin/products/edit/' . $product['id_product']) ?>"
                                       class="btn-edit text-decoration-none"
                                       title="Edit Product">

                                        <i class="bi bi-pencil"></i>

                                    </a>


                                    <form
                                        action="<?= site_url('admin/products/delete/' . $product['id_product']) ?>"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus produk ini?')">

                                        <?= csrf_field() ?>

                                        <button type="submit"
                                                class="btn-delete"
                                                title="Delete Product">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        <?php endforeach; ?>


                    <?php else: ?>

                        <tr>

                            <td colspan="6" class="text-center py-5">

                                <i class="bi bi-box-seam fs-1 text-secondary"></i>

                                <p class="mt-2 mb-0 text-secondary">
                                    No products found.
                                </p>

                                <small class="text-secondary">
                                    Try changing your search or filter.
                                </small>

                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>


        <!-- PAGINATION -->

        <?php if ($pager->getPageCount('products') > 1): ?>

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mt-3">

                <small class="text-secondary">

                    Page <?= $pager->getCurrentPage('products') ?>

                    of <?= $pager->getPageCount('products') ?>

                </small>

                <?= $pager
                    ->only(['keyword', 'category', 'stock_status'])
                    ->links('products', 'default_full') ?>

            </div>

        <?php endif; ?>

    </div>


    <!-- FOOTER -->

    <div class="footer">

        © <?= date('Y') ?> ShopEase. All rights reserved.

    </div>

</main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
