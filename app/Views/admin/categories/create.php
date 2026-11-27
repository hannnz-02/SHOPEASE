
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Category | ShopEase</title>

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

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--background);
            font-family: Arial, sans-serif;
            color: var(--dark);
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: white;
            border-right: 1px solid #E8EFED;
            padding: 25px 18px;
        }

        .brand {
            font-size: 23px;
            font-weight: 800;
            color: var(--primary);
            padding: 5px 12px 35px;
        }

        .brand i { margin-right: 8px; }

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

        .main-content {
            margin-left: 250px;
            padding: 25px 35px;
        }

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

        .page-title h2 {
            font-size: 27px;
            font-weight: 750;
        }

        .page-title p {
            color: var(--muted);
            margin-top: 7px;
        }

        .content-card {
            background: white;
            border: 1px solid #EDF1F0;
            border-radius: 14px;
            padding: 28px;
            max-width: 850px;
        }

        .form-label {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 9px;
        }

        .form-control {
            padding: 12px 14px;
            border-radius: 9px;
            border: 1px solid #E2EAE7;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(23,100,95,.1);
        }

        .btn-primary-custom {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 9px;
            padding: 11px 20px;
            font-size: 14px;
            text-decoration: none;
        }

        .btn-primary-custom:hover {
            background: #124F4B;
            color: white;
        }

        .btn-cancel {
            background: #EEF2F1;
            color: #52635F;
            border-radius: 9px;
            padding: 11px 20px;
            font-size: 14px;
            text-decoration: none;
        }

        .footer {
            color: #A0AEAB;
            font-size: 12px;
            text-align: center;
            padding: 35px 0 10px;
        }

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

<aside class="sidebar">
    <div class="brand">
        <i class="bi bi-bag-check-fill"></i> ShopEase.
    </div>

    <div class="menu-label">MAIN MENU</div>

    <a href="<?= site_url('admin') ?>" class="nav-link">
        <i class="bi bi-grid"></i> Dashboard
    </a>

    <div class="menu-label">MANAGEMENT</div>

    <a href="<?= site_url('admin/products') ?>" class="nav-link">
        <i class="bi bi-box-seam"></i> Products
    </a>

    <a href="<?= site_url('admin/categories') ?>" class="nav-link active">
        <i class="bi bi-tags"></i> Categories
    </a>

    <a href="#" class="nav-link">
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

<main class="main-content">

    <div class="topbar">
        <div class="fw-semibold">Category Management</div>

        <div class="admin-profile">
            <div class="text-end d-none d-sm-block">
                <div class="fw-bold small">
                    <?= esc(session()->get('name')) ?>
                </div>
                <small class="text-secondary">Administrator</small>
            </div>

            <div class="avatar">
                <i class="bi bi-person-fill"></i>
            </div>
        </div>
    </div>

    <section class="page-title mb-4">
        <h2>Add Category</h2>
        <p>Add a new category to organize your products.</p>
    </section>

    <?php $errors = session()->getFlashdata('errors') ?? []; ?>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <strong>Please check the following:</strong>
            <ul class="mb-0 mt-2">
                <?php foreach ($errors as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="content-card">

        <h5 class="fw-bold mb-1">Category Information</h5>
        <p class="text-secondary small mb-4">
            Fill in the details below to create a category.
        </p>

        <form action="<?= site_url('admin/categories/store') ?>" method="POST">

            <?= csrf_field() ?>

            <div class="mb-4">
                <label class="form-label">Category Name *</label>

                <input type="text"
                    name="category_name"
                    class="form-control"
                    placeholder="Example: Smartphone"
                    value="<?= esc(old('category_name') ?? '') ?>"
                    required>
            </div>

            <div class="mb-4">
                <label class="form-label">Description</label>

                <textarea name="description"
                    class="form-control"
                    rows="5"
                    placeholder="Enter category description..."><?= esc(old('description') ?? '') ?></textarea>
            </div>

            <div class="d-flex gap-2 justify-content-end">
                <a href="<?= site_url('admin/categories') ?>"
                    class="btn-cancel">
                    Cancel
                </a>

                <button type="submit" class="btn-primary-custom">
                    <i class="bi bi-plus-lg me-1"></i>
                    Save Category
                </button>
            </div>

        </form>
    </div>

    <div class="footer">
        © <?= date('Y') ?> ShopEase. All rights reserved.
    </div>

</main>

</body>
</html>
