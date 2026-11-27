
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
            color: #D9534F;
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

        /* FORM */
        .content-card {
            background: white;
            border: 1px solid #E8EFED;
            border-radius: 14px;
            padding: 28px;
            max-width: 900px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #52645F;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            padding: 11px 13px;
            border: 1px solid #DCE6E3;
            border-radius: 8px;
            font-size: 14px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(23, 100, 95, .1);
        }

        .form-text {
            font-size: 12px;
            color: var(--muted);
        }

        .btn-save {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 11px 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .btn-save:hover {
            background: #124E4A;
            color: white;
        }

        .btn-cancel {
            background: #F0F3F2;
            color: #687A76;
            border: none;
            border-radius: 8px;
            padding: 11px 20px;
            font-size: 14px;
            text-decoration: none;
        }

        .btn-cancel:hover {
            background: #E2E9E7;
            color: var(--dark);
        }

        .alert {
            border-radius: 10px;
            font-size: 14px;
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

        <a href="<?= base_url('admin') ?>" class="nav-link">
            <i class="bi bi-grid"></i> Dashboard
        </a>

        <div class="menu-label">MANAGEMENT</div>

        <a href="<?= base_url('admin/products') ?>" class="nav-link">
            <i class="bi bi-box-seam"></i> Products
        </a>

        <a href="<?= base_url('admin/categories') ?>" class="nav-link">
            <i class="bi bi-tags"></i> Categories
        </a>

        <a href="<?= base_url('admin/users') ?>" class="nav-link active">
            <i class="bi bi-people"></i> Users
        </a>

        <div class="menu-label">ACCOUNT</div>

        <form action="<?= base_url('logout') ?>" method="POST">
            <?= csrf_field() ?>
            <button type="submit" class="nav-link logout-link w-100 text-start border-0 bg-transparent">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>

    </aside>


    <!-- MAIN CONTENT -->
    <main class="main-content">

        <!-- TOPBAR -->
        <div class="topbar">
            <h5>Edit User</h5>

            <div class="profile">
                <div class="profile-icon">
                    <i class="bi bi-person-fill"></i>
                </div>

                <div class="profile-info">
                    <strong><?= esc(session()->get('name') ?? 'Administrator') ?></strong>
                    <small>Administrator</small>
                </div>
            </div>
        </div>


        <!-- PAGE HEADING -->
        <div class="page-heading">
            <h4>Edit Pengguna</h4>
            <p>Perbarui informasi dan hak akses pengguna ShopEase.</p>
        </div>


        <!-- FORM CARD -->
        <div class="content-card">

            <div class="d-flex align-items-center gap-2 mb-4">
                <i class="bi bi-person-gear fs-5" style="color: var(--primary);"></i>
                <h6 class="fw-bold mb-0">Informasi Pengguna</h6>
            </div>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <strong>Periksa kembali data berikut:</strong>
                    <ul class="mb-0 mt-2">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('admin/users/update/' . $user['id_user']) ?>"
                  method="POST">

                <?= csrf_field() ?>

                <!-- ID USER -->
                <div class="mb-3">
                    <label class="form-label">ID Pengguna</label>
                    <input type="text"
                           class="form-control"
                           value="<?= esc($user['id_user']) ?>"
                           disabled>
                    <div class="form-text">
                        ID pengguna tidak dapat diubah.
                    </div>
                </div>

                <!-- NAME -->
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text"
                           name="name"
                           class="form-control"
                           placeholder="Masukkan nama pengguna"
                           value="<?= esc(old('name', $user['name'])) ?>"
                           required>
                </div>

                <!-- EMAIL -->
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           placeholder="Masukkan email pengguna"
                           value="<?= esc(old('email', $user['email'])) ?>"
                           required>
                </div>

                <!-- PHONE -->
                <div class="mb-3">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text"
                           name="phone"
                           class="form-control"
                           placeholder="Masukkan nomor telepon"
                           value="<?= esc(old('phone', $user['phone'] ?? '')) ?>">
                </div>

                <!-- ADDRESS -->
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="address"
                              class="form-control"
                              rows="3"
                              placeholder="Masukkan alamat pengguna"><?= esc(old('address', $user['address'] ?? '')) ?></textarea>
                </div>

                <!-- ROLE -->
                <div class="mb-4">
                    <label class="form-label">Role Pengguna</label>

                    <select name="role" class="form-select" required>
                        <option value="customer"
                            <?= old('role', $user['role']) === 'customer' ? 'selected' : '' ?>>
                            Customer
                        </option>

                        <option value="operator"
                            <?= old('role', $user['role']) === 'operator' ? 'selected' : '' ?>>
                            Operator
                        </option>

                        <option value="admin"
                            <?= old('role', $user['role']) === 'admin' ? 'selected' : '' ?>>
                            Admin
                        </option>
                    </select>

                    <div class="form-text">
                        Role menentukan hak akses pengguna di dalam aplikasi.
                    </div>
                </div>

                <!-- BUTTONS -->
                <div class="d-flex gap-2 pt-2">

                    <button type="submit" class="btn-save">
                        <i class="bi bi-check-circle me-1"></i>
                        Simpan Perubahan
                    </button>

                    <a href="<?= base_url('admin/users') ?>" class="btn-cancel">
                        Batal
                    </a>

                </div>

            </form>

        </div>

    </main>

</body>
</html>
