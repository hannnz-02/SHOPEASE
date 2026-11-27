<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard | ShopEase</title>

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
            display: flex;
            flex-direction: column;
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

        .sidebar-bottom {
            margin-top: 0;
        }

        .logout-button {
            display: block;
            width: 100%;
            color: #687A76;
            padding: 12px 14px;
            border-radius: 9px;
            margin-bottom: 6px;
            font-size: 14px;
            text-align: left;
            cursor: pointer;
        }

        .logout-button:hover {
            background: #FFF0EF !important;
            color: #C65A51 !important;
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
            border: 1px solid #EDF1F0;
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
            color: var(--dark);
            margin: 0;
        }

        .page-title p {
            color: var(--muted);
            margin-top: 7px;
            font-size: 14px;
        }

        /* WELCOME CARD */
        .welcome-card {
            background: linear-gradient(110deg, #17645F, #26877D);
            color: white;
            padding: 30px;
            border-radius: 14px;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .welcome-card h3 {
            font-size: 23px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .welcome-card p {
            font-size: 13px;
            margin: 0;
            opacity: 0.9;
        }

        .welcome-icon {
            position: absolute;
            right: 40px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 85px;
            opacity: 0.15;
        }

        /* SECTION TITLE */
        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: var(--dark);
            margin-bottom: 18px;
        }

        /* STATISTICS */
        .stat-card {
            background: white;
            border: 1px solid #EDF1F0;
            border-radius: 14px;
            padding: 22px;
            height: 100%;
            transition: 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 18px rgba(23, 100, 95, 0.08);
        }

        .stat-icon {
            width: 45px;
            height: 45px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
            margin-bottom: 16px;
        }

        .icon-green {
            background: #E5F3F0;
            color: #17645F;
        }

        .icon-blue {
            background: #EAF1FC;
            color: #3975C6;
        }

        .icon-orange {
            background: #FFF1E4;
            color: #E58B37;
        }

        .icon-purple {
            background: #F1EBFC;
            color: #8760C7;
        }

        .stat-label {
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: 27px;
            font-weight: bold;
            color: var(--dark);
            margin: 0;
        }

        /* MANAGEMENT */
        .management-card {
            background: white;
            border: 1px solid #EDF1F0;
            border-radius: 14px;
            padding: 23px;
            height: 100%;
            transition: 0.2s;
        }

        .management-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 18px rgba(23, 100, 95, 0.08);
        }

        .management-icon {
            width: 47px;
            height: 47px;
            background: var(--primary-light);
            color: var(--primary);
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 17px;
        }

        .management-card h5 {
            font-size: 15px;
            font-weight: bold;
            color: var(--dark);
            margin-bottom: 9px;
        }

        .management-card p {
            font-size: 12px;
            color: var(--muted);
            line-height: 1.6;
            min-height: 40px;
        }

        .management-btn {
            display: inline-block;
            color: var(--primary);
            font-size: 12px;
            font-weight: bold;
            text-decoration: none;
            margin-top: 8px;
        }

        .management-btn:hover {
            color: #124F4B;
        }

        /* FOOTER */
        .footer {
            color: #A0AEAB;
            font-size: 12px;
            text-align: center;
            padding: 35px 0 10px;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                min-height: auto;
            }

            .sidebar-bottom {
                margin-top: 10px;
            }

            .main-content {
                margin-left: 0;
                padding: 20px 15px;
            }

            .welcome-icon {
                display: none;
            }

            .topbar {
                gap: 12px;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <!-- BRAND -->
        <div class="brand">
            <i class="bi bi-bag-check-fill"></i>ShopEase.
        </div>

        <!-- MAIN MENU -->
        <div class="menu-label">MAIN MENU</div>

        <a href="<?= site_url('admin') ?>"
           class="nav-link active">
            <i class="bi bi-grid"></i>
            Dashboard
        </a>

        <!-- MANAGEMENT -->
        <div class="menu-label">MANAGEMENT</div>

        <a href="<?= site_url('admin/products') ?>"
           class="nav-link">
            <i class="bi bi-box-seam"></i>
            Products
        </a>

        <a href="<?= site_url('admin/categories') ?>"
           class="nav-link">
            <i class="bi bi-tags"></i>
            Categories
        </a>

        <a href="<?= site_url('admin/users') ?>"
           class="nav-link">
            <i class="bi bi-people"></i>
            Users
        </a>

        <!-- ACCOUNT -->
        <div class="menu-label">ACCOUNT</div>

        <div class="sidebar-bottom">
            <form action="<?= site_url('logout') ?>" method="POST">
                <?= csrf_field() ?>

                <button type="submit"
                        class="nav-link logout-button border-0 bg-transparent">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </button>
            </form>
        </div>

    </aside>


    <!-- MAIN CONTENT -->
    <main class="main-content">

        <!-- TOPBAR -->
        <div class="topbar">

            <div class="fw-semibold">
                Admin Dashboard
            </div>

            <div class="admin-profile">

                <div class="text-end d-none d-sm-block">
                    <div class="fw-bold small">
                        <?= esc(session()->get('name') ?? 'Administrator') ?>
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

            <h2>Dashboard</h2>

            <p>
                Welcome to your ShopEase administration dashboard.
            </p>

        </section>


        <!-- WELCOME CARD -->
        <section class="welcome-card">

            <h3>
                Welcome back, Admin! 👋
            </h3>

            <p>
                Manage your products, categories, and users
                efficiently through ShopEase.
            </p>

            <i class="bi bi-shop welcome-icon"></i>

        </section>


        <!-- OVERVIEW -->
        <section class="mb-4">

            <h4 class="section-title">
                Overview
            </h4>

            <div class="row g-3">

                <!-- TOTAL PRODUCTS -->
                <div class="col-xl-4 col-md-6">

                    <div class="stat-card">

                        <div class="stat-icon icon-green">
                            <i class="bi bi-box-seam"></i>
                        </div>

                        <p class="stat-label">
                            Total Products
                        </p>

                        <h3 class="stat-value">
                            <?= esc($totalProducts ?? 0) ?>
                        </h3>

                    </div>

                </div>


                <!-- TOTAL CATEGORIES -->
                <div class="col-xl-4 col-md-6">

                    <div class="stat-card">

                        <div class="stat-icon icon-blue">
                            <i class="bi bi-tags"></i>
                        </div>

                        <p class="stat-label">
                            Total Categories
                        </p>

                        <h3 class="stat-value">
                            <?= esc($totalCategories ?? 0) ?>
                        </h3>

                    </div>

                </div>


                <!-- AVAILABLE PRODUCTS -->
                <div class="col-xl-4 col-md-6">

                    <div class="stat-card">

                        <div class="stat-icon icon-green">
                            <i class="bi bi-check-circle"></i>
                        </div>

                        <p class="stat-label">
                            Available Products
                        </p>

                        <h3 class="stat-value">
                            <?= esc($availableProducts ?? 0) ?>
                        </h3>

                    </div>

                </div>


                <!-- UNAVAILABLE PRODUCTS -->
                <div class="col-xl-4 col-md-6">

                    <div class="stat-card">

                        <div class="stat-icon icon-orange">
                            <i class="bi bi-exclamation-circle"></i>
                        </div>

                        <p class="stat-label">
                            Unavailable Products
                        </p>

                        <h3 class="stat-value">
                            <?= esc($unavailableProducts ?? 0) ?>
                        </h3>

                    </div>

                </div>


                <!-- TOTAL USERS -->
                <div class="col-xl-4 col-md-6">

                    <div class="stat-card">

                        <div class="stat-icon icon-orange">
                            <i class="bi bi-people"></i>
                        </div>

                        <p class="stat-label">
                            Total Users
                        </p>

                        <h3 class="stat-value">
                            <?= esc($totalUsers ?? 0) ?>
                        </h3>

                    </div>

                </div>


                <!-- TOTAL TRANSACTIONS -->
                <div class="col-xl-4 col-md-6">

                    <div class="stat-card">

                        <div class="stat-icon icon-purple">
                            <i class="bi bi-cart-check"></i>
                        </div>

                        <p class="stat-label">
                            Total Transactions
                        </p>

                        <h3 class="stat-value">
                            <?= esc($totalTransactions ?? 0) ?>
                        </h3>

                    </div>

                </div>

            </div>

        </section>


        <!-- MANAGEMENT -->
        <section class="mt-4">

            <h4 class="section-title">
                Management
            </h4>

            <div class="row g-3">

                <!-- PRODUCT MANAGEMENT -->
                <div class="col-lg-4 col-md-6">

                    <div class="management-card">

                        <div class="management-icon">
                            <i class="bi bi-box-seam"></i>
                        </div>

                        <h5>
                            Product Management
                        </h5>

                        <p>
                            Add, edit, delete, and manage
                            all electronic products in your store.
                        </p>

                        <a href="<?= site_url('admin/products') ?>"
                           class="management-btn">
                            Manage Products
                            <i class="bi bi-arrow-right"></i>
                        </a>

                    </div>

                </div>


                <!-- CATEGORY MANAGEMENT -->
                <div class="col-lg-4 col-md-6">

                    <div class="management-card">

                        <div class="management-icon">
                            <i class="bi bi-tags"></i>
                        </div>

                        <h5>
                            Category Management
                        </h5>

                        <p>
                            Organize and manage product categories
                            in your ShopEase store.
                        </p>

                        <a href="<?= site_url('admin/categories') ?>"
                           class="management-btn">
                            Manage Categories
                            <i class="bi bi-arrow-right"></i>
                        </a>

                    </div>

                </div>


                <!-- USER MANAGEMENT -->
                <div class="col-lg-4 col-md-6">

                    <div class="management-card">

                        <div class="management-icon">
                            <i class="bi bi-people"></i>
                        </div>

                        <h5>
                            User Management
                        </h5>

                        <p>
                            View and manage accounts
                            registered in ShopEase.
                        </p>

                        <a href="<?= site_url('admin/users') ?>"
                           class="management-btn">
                            Manage Users
                            <i class="bi bi-arrow-right"></i>
                        </a>

                    </div>

                </div>

            </div>

        </section>


        <!-- FOOTER -->
        <div class="footer">
            © <?= date('Y') ?> ShopEase. All rights reserved.
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>