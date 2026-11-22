
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Operator Dashboard | ShopEase</title>

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
            color: #687A76;
            padding: 12px 14px;
            border-radius: 9px;
            margin-bottom: 6px;
            font-size: 14px;
            transition: .2s;
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

        .search-box {
            background: #F5F8F7;
            border: 1px solid #E9EFED;
            border-radius: 9px;
            padding: 9px 13px;
            width: 270px;
        }

        .search-box input {
            border: none;
            outline: none;
            background: transparent;
            width: 85%;
            font-size: 13px;
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
            font-weight: bold;
        }

        .welcome {
            margin-bottom: 28px;
        }

        .welcome h2 {
            font-weight: 750;
            font-size: 27px;
        }

        .welcome p {
            color: var(--muted);
            margin-top: 7px;
        }

        .stat-card {
            background: white;
            padding: 22px;
            border-radius: 14px;
            border: 1px solid #EDF1F0;
            height: 100%;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            font-size: 20px;
            margin-bottom: 18px;
        }

        .icon-green {
            background: #E5F3F0;
            color: #17645F;
        }

        .icon-blue {
            background: #EAF1FC;
            color: #4776BB;
        }

        .icon-orange {
            background: #FFF1E4;
            color: #DB873D;
        }

        .stat-card h3 {
            font-size: 25px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .stat-card p {
            color: var(--muted);
            font-size: 13px;
            margin: 0;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 18px;
        }

        .management-card {
            background: white;
            border: 1px solid #EDF1F0;
            border-radius: 14px;
            padding: 23px;
            height: 100%;
            transition: .2s;
        }

        .management-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(23,100,95,.08);
        }

        .management-card h5 {
            font-size: 16px;
            font-weight: bold;
            margin: 15px 0 8px;
        }

        .management-card p {
            font-size: 13px;
            color: var(--muted);
            min-height: 38px;
        }

        .management-card a {
            color: var(--primary);
            font-size: 13px;
            font-weight: bold;
            text-decoration: none;
        }

        .footer {
            color: #A0AEAB;
            font-size: 12px;
            text-align: center;
            padding: 35px 0 10px;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                border-right: none;
                border-bottom: 1px solid #E8EFED;
            }

            .main-content {
                margin-left: 0;
                padding: 20px 15px;
            }

            .search-box {
                display: none;
            }

            .brand {
                padding-bottom: 15px;
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

    <a href="<?= site_url('operator') ?>" class="nav-link active">
        <i class="bi bi-grid"></i> Dashboard
    </a>

    <div class="menu-label">OPERATIONS</div>

    <a href="#" class="nav-link">
        <i class="bi bi-receipt"></i> Orders
    </a>

    <a href="#" class="nav-link">
        <i class="bi bi-credit-card"></i> Transactions
    </a>

    <div class="menu-label">ACCOUNT</div>

    <form action="<?= site_url('logout') ?>" method="POST">
        <?= csrf_field() ?>
        <button type="submit" class="nav-link w-100 text-start border-0 bg-transparent">
            <i class="bi bi-box-arrow-right"></i> Logout
        </button>
    </form>

</aside>

<!-- MAIN CONTENT -->
<main class="main-content">

    <div class="topbar">

        <div class="search-box">
            <i class="bi bi-search text-secondary"></i>
            <input type="text" placeholder="Search orders...">
        </div>

        <div class="admin-profile">
            <div class="text-end d-none d-sm-block">
                <div class="fw-bold small">
                    <?= esc(session()->get('name')) ?>
                </div>
                <small class="text-secondary">Operator</small>
            </div>

            <div class="avatar">
                <i class="bi bi-person-fill"></i>
            </div>
        </div>

    </div>

    <!-- WELCOME -->
    <section class="welcome">
        <h2>Operator Dashboard</h2>
        <p>
            Welcome back,
            <strong><?= esc(session()->get('name')) ?></strong>!
            Here's your store operations overview.
        </p>
    </section>

    <!-- STATISTICS -->
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon icon-green">
                    <i class="bi bi-receipt"></i>
                </div>
                <h3>—</h3>
                <p>Total Orders</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon icon-orange">
                    <i class="bi bi-clock-history"></i>
                </div>
                <h3>—</h3>
                <p>Pending Orders</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon icon-blue">
                    <i class="bi bi-credit-card"></i>
                </div>
                <h3>—</h3>
                <p>Transactions</p>
            </div>
        </div>

    </div>

    <!-- MANAGEMENT -->
    <h5 class="section-title">Order & Transaction Management</h5>

    <div class="row g-3">

        <div class="col-md-6">
            <div class="management-card">
                <div class="stat-icon icon-green">
                    <i class="bi bi-receipt"></i>
                </div>

                <h5>Order Management</h5>

                <p>
                    View customer orders, check order details,
                    and update order status.
                </p>

                <a href="#">
                    Manage Orders <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="management-card">
                <div class="stat-icon icon-blue">
                    <i class="bi bi-credit-card"></i>
                </div>

                <h5>Transaction Management</h5>

                <p>
                    Review customer payments and
                    monitor transaction status.
                </p>

                <a href="#">
                    Manage Transactions <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

    </div>

    <div class="footer">
        © <?= date('Y') ?> ShopEase. All rights reserved.
    </div>

</main>

</body>
</html>
