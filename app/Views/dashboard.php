
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Operator Dashboard - ShopEase</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #F4F9F7;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background: #17645F;
        }

        .navbar-brand {
            color: white;
            font-weight: bold;
        }

        .dashboard-card {
            background: white;
            border: none;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .text-teal {
            color: #17645F;
        }
    </style>
</head>

<body>

<nav class="navbar px-4">
    <span class="navbar-brand">ShopEase Operator</span>

    <form action="<?= site_url('logout') ?>" method="POST">
        <?= csrf_field() ?>
        <button type="submit" class="btn btn-light btn-sm">
            Logout
        </button>
    </form>
</nav>

<div class="container py-5">

    <h2 class="text-teal fw-bold">Operator Dashboard</h2>

    <p class="text-secondary">
        Welcome, <?= esc(session()->get('name')) ?>!
    </p>

    <div class="row g-4 mt-2">

        <div class="col-md-6">
            <div class="dashboard-card">
                <h5>Order Management</h5>
                <p class="text-secondary mb-0">
                    Manage customer orders.
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="dashboard-card">
                <h5>Transaction Management</h5>
                <p class="text-secondary mb-0">
                    Manage customer transactions.
                </p>
            </div>
        </div>

    </div>

</div>

</body>
</html>
