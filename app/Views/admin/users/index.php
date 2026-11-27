
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= esc($title) ?> | ShopEase</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

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

        .logout-link {
            color: #5c5353 ;
        }

        .logout-link:hover {
            background: #FCEDEC;
            color: #C0392B;
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 250px;
            padding: 30px;
        }

        .topbar {
            background: white;
            padding: 17px 24px;
            border-radius: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            border: 1px solid #E8EFED;
        }

        .topbar h5 {
            margin: 0;
            font-weight: 700;
            color: var(--dark);
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .profile-icon {
            width: 40px;
            height: 40px;
            background: var(--primary-light);
            color: var(--primary);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 19px;
        }

        .profile-info small {
            color: var(--muted);
            display: block;
            font-size: 12px;
        }

        .profile-info strong {
            font-size: 14px;
        }

        .page-heading {
            margin-bottom: 22px;
        }

        .page-heading h4 {
            font-weight: 700;
            margin-bottom: 6px;
        }

        .page-heading p {
            color: var(--muted);
            font-size: 14px;
            margin: 0;
        }

        /* CONTENT CARD */
        .content-card {
            background: white;
            border: 1px solid #E8EFED;
            border-radius: 14px;
            padding: 24px;
        }

        /* SEARCH AND FILTER */
        .search-input,
        .filter-select {
            border: 1px solid #DCE6E3;
            border-radius: 8px;
            font-size: 13px;
            padding: 10px 12px;
        }

        .search-input:focus,
        .filter-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(23, 100, 95, .1);
        }

        .search-icon {
            background: white;
            border: 1px solid #DCE6E3;
            border-right: none;
            border-radius: 8px 0 0 8px;
            color: var(--muted);
        }

        .search-input {
            border-radius: 0 8px 8px 0;
        }

        .btn-filter {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 13px;
            font-weight: 600;
        }

        .btn-filter:hover {
            background: #124E4A;
            color: white;
        }

        .btn-reset {
            background: #F0F3F2;
            color: #687A76;
            border: none;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 13px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-reset:hover {
            background: #E2E9E7;
            color: var(--dark);
        }

        /* TABLE */
        .table {
            vertical-align: middle;
            margin-bottom: 0;
        }

        .table thead th {
            background: #F7FAF9;
            color: #687A76;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .5px;
            padding: 15px 12px;
            border-bottom: 1px solid #E8EFED;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 15px 12px;
            font-size: 13px;
            color: #52645F;
            border-bottom: 1px solid #EEF2F1;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .user-name {
            font-weight: 600;
            color: var(--dark);
        }

        /* ROLE BADGE */
        .role-badge {
            padding: 6px 11px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            display: inline-block;
        }

        .role-admin {
            background: #E5F3F0;
            color: #17645F;
        }

        .role-operator {
            background: #FFF3D9;
            color: #A87513;
        }

        .role-customer {
            background: #EAF0FF;
            color: #4969B0;
        }

        /* ACTION BUTTON */
        .btn-edit {
            background: var(--primary-light);
            color: var(--primary);
            border: none;
            border-radius: 7px;
            padding: 7px 10px;
            font-size: 13px;
            text-decoration: none;
        }

        .btn-edit:hover {
            background: var(--primary);
            color: white;
        }

        .btn-delete {
            background: #FCEDEC;
            color: #D9534F;
            border: none;
            border-radius: 7px;
            padding: 7px 10px;
            font-size: 13px;
        }

        .btn-delete:hover {
            background: #D9534F;
            color: white;
        }

        /* PAGINATION */
        .pagination {
            margin-bottom: 0;
            gap: 5px;
        }

        .pagination .page-link {
            color: var(--primary);
            border: 1px solid #E2EAE7;
            border-radius: 7px;
            font-size: 13px;
            padding: 8px 12px;
        }

        .pagination .page-item.active .page-link {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .pagination .page-item.disabled .page-link {
            color: #A0AEAB;
            background: #F5F8F7;
        }

        .alert {
            border-radius: 10px;
            font-size: 14px;
        }

        .empty-state {
            text-align: center;
            padding: 45px 15px;
            color: var(--muted);
        }

        .empty-state i {
            font-size: 38px;
            display: block;
            margin-bottom: 12px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 200px;
                padding: 18px;
            }

            .topbar {
                padding: 15px;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="brand">
            <i class="bi bi-bag-check-fill"></i>ShopEase.
        </div>

        <div class="menu-label">MAIN MENU</div>

        <a href="<?= site_url('admin') ?>" class="nav-link">
            <i class="bi bi-grid"></i> Dashboard
        </a>

        <div class="menu-label">MANAGEMENT</div>

        <a href="<?= site_url('admin/products') ?>" class="nav-link">
            <i class="bi bi-box-seam"></i> Products
        </a>

        <a href="<?= site_url('admin/categories') ?>" class="nav-link">
            <i class="bi bi-tags"></i> Categories
        </a>

        <a href="<?= site_url('admin/users') ?>" class="nav-link active">
            <i class="bi bi-people"></i> Users
        </a>

        <div class="menu-label">ACCOUNT</div>

        <form action="<?= site_url('logout') ?>" method="POST">
            <?= csrf_field() ?>

            <button type="submit"
                    class="nav-link logout-link w-100 text-start border-0 bg-transparent">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>

    </aside>


    <!-- MAIN CONTENT -->
    <main class="main-content">

        <!-- TOPBAR -->
        <div class="topbar">

            <h5>User Management</h5>

            <div class="profile">

                <div class="profile-icon">
                    <i class="bi bi-person-fill"></i>
                </div>

                <div class="profile-info">

                    <strong>
                        <?= esc(session()->get('name') ?? 'Administrator') ?>
                    </strong>

                    <small>Administrator</small>

                </div>

            </div>

        </div>


        <!-- PAGE HEADING -->
        <div class="page-heading">

            <h4>Users</h4>

            <p>
                Kelola informasi dan hak akses pengguna ShopEase.
            </p>

        </div>


        <!-- FLASH MESSAGE -->
        <?php if (session()->getFlashdata('success')): ?>

            <div class="alert alert-success alert-dismissible fade show">

                <i class="bi bi-check-circle me-2"></i>

                <?= esc(session()->getFlashdata('success')) ?>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"></button>

            </div>

        <?php endif; ?>


        <?php if (session()->getFlashdata('error')): ?>

            <div class="alert alert-danger alert-dismissible fade show">

                <i class="bi bi-exclamation-circle me-2"></i>

                <?= esc(session()->getFlashdata('error')) ?>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"></button>

            </div>

        <?php endif; ?>


        <!-- USER TABLE CARD -->
        <div class="content-card">

            <!-- CARD HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>

                    <h6 class="fw-bold mb-1">
                        Daftar Pengguna
                    </h6>

                    <small class="text-secondary">
                        Menampilkan <?= count($users) ?> pengguna pada halaman ini
                    </small>

                </div>

            </div>


            <!-- SEARCH AND FILTER -->
            <form action="<?= site_url('admin/users') ?>"
                  method="GET"
                  class="row g-2 align-items-center mb-4">

                <!-- SEARCH INPUT -->
                <div class="col-lg-5 col-md-12">

                    <div class="input-group">

                        <span class="input-group-text search-icon">
                            <i class="bi bi-search"></i>
                        </span>

                        <input type="text"
                               name="keyword"
                               class="form-control search-input"
                               placeholder="Cari nama atau email pengguna..."
                               value="<?= esc($keyword ?? '') ?>">

                    </div>

                </div>


                <!-- ROLE FILTER -->
                <div class="col-lg-3 col-md-5">

                    <select name="role"
                            class="form-select filter-select">

                        <option value="">Semua Role</option>

                        <option value="admin"
                            <?= ($selectedRole ?? '') === 'admin' ? 'selected' : '' ?>>
                            Admin
                        </option>

                        <option value="operator"
                            <?= ($selectedRole ?? '') === 'operator' ? 'selected' : '' ?>>
                            Operator
                        </option>

                        <option value="customer"
                            <?= ($selectedRole ?? '') === 'customer' ? 'selected' : '' ?>>
                            Customer
                        </option>

                    </select>

                </div>


                <!-- FILTER BUTTON -->
                <div class="col-lg-2 col-md-4">

                    <button type="submit" class="btn-filter w-100">

                        <i class="bi bi-funnel me-1"></i>
                        Filter

                    </button>

                </div>


                <!-- RESET BUTTON -->
                <div class="col-lg-2 col-md-3">

                    <a href="<?= site_url('admin/users') ?>"
                       class="btn-reset w-100">

                        <i class="bi bi-arrow-counterclockwise me-1"></i>
                        Reset

                    </a>

                </div>

            </form>


            <!-- TABLE -->
            <div class="table-responsive">

                <?php if (!empty($users)): ?>

                    <table class="table">

                        <thead>

                            <tr>
                                <th>ID</th>
                                <th>Nama Pengguna</th>
                                <th>Email</th>
                                <th>No. Telepon</th>
                                <th>Role</th>
                                <th class="text-center">Aksi</th>
                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach ($users as $user): ?>

                                <tr>

                                    <!-- ID -->
                                    <td>
                                        <?= esc($user['id_user']) ?>
                                    </td>


                                    <!-- NAME -->
                                    <td>
                                        <span class="user-name">
                                            <?= esc($user['name']) ?>
                                        </span>
                                    </td>


                                    <!-- EMAIL -->
                                    <td>
                                        <?= esc($user['email']) ?>
                                    </td>


                                    <!-- PHONE -->
                                    <td>
                                        <?= esc($user['phone'] ?: '-') ?>
                                    </td>


                                    <!-- ROLE -->
                                    <td>

                                        <?php
                                            $roleClass = 'role-customer';

                                            if ($user['role'] === 'admin') {
                                                $roleClass = 'role-admin';
                                            } elseif ($user['role'] === 'operator') {
                                                $roleClass = 'role-operator';
                                            }
                                        ?>

                                        <span class="role-badge <?= $roleClass ?>">
                                            <?= esc(ucfirst($user['role'])) ?>
                                        </span>

                                    </td>


                                    <!-- ACTION -->
                                    <td class="text-center">

                                        <div class="d-flex justify-content-center gap-2">

                                            <!-- EDIT -->
                                            <a href="<?= site_url('admin/users/edit/' . $user['id_user']) ?>"
                                               class="btn-edit"
                                               title="Edit pengguna">

                                                <i class="bi bi-pencil-square"></i>

                                            </a>


                                            <!-- DELETE -->
                                            <form action="<?= site_url('admin/users/delete/' . $user['id_user']) ?>"
                                                  method="POST"
                                                  onsubmit="return confirm('Apakah kamu yakin ingin menghapus pengguna ini?')">

                                                <?= csrf_field() ?>

                                                <button type="submit"
                                                        class="btn-delete"
                                                        title="Hapus pengguna">

                                                    <i class="bi bi-trash"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                <?php else: ?>

                    <!-- EMPTY STATE -->
                    <div class="empty-state">

                        <i class="bi bi-people"></i>

                        <h6>Tidak Ada Pengguna</h6>

                        <p>
                            Tidak ditemukan pengguna yang sesuai dengan pencarian.
                        </p>

                    </div>

                <?php endif; ?>

            </div>


            <!-- PAGINATION -->
            <?php if ($pager->getPageCount('users') > 1): ?>

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mt-4">

                    <small class="text-secondary">
                        Halaman <?= $pager->getCurrentPage('users') ?>
                        dari <?= $pager->getPageCount('users') ?>
                    </small>

                    <?= $pager->only(['keyword', 'role'])->links('users', 'default_full') ?>

                </div>

            <?php endif; ?>

        </div>

    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
