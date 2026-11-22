
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - ShopEase</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #F4F9F7;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
        }

        .auth-card {
            width: 100%;
            max-width: 430px;
            background: white;
            border-radius: 18px;
            padding: 40px;
            box-shadow: 0 8px 30px rgba(23, 100, 95, 0.10);
        }

        .brand {
            color: #17645F;
            font-size: 30px;
            font-weight: bold;
        }

        .subtitle {
            color: #71817D;
        }

        .form-control {
            padding: 12px;
            border-radius: 9px;
        }

        .btn-teal {
            background: #17645F;
            color: white;
            padding: 12px;
            border-radius: 9px;
            font-weight: bold;
        }

        .btn-teal:hover {
            background: #124E4A;
            color: white;
        }

        .form-label {
            font-weight: 600;
            color: #304A46;
        }

        a {
            color: #17645F;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>

<body>

<div class="auth-card">

    <div class="text-center mb-4">
        <h1 class="brand">ShopEase</h1>
        <p class="subtitle">Welcome back! Please login to your account.</p>
        <h4 class="mt-4">Login</h4>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= esc(session()->getFlashdata('success')) ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= esc(session()->getFlashdata('error')) ?>
        </div>
    <?php endif; ?>

    <?php if (isset($validation)): ?>
        <div class="alert alert-danger">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('login') ?>" method="POST">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input
                type="email"
                name="email"
                class="form-control"
                value="<?= esc(old('email')) ?>"
                placeholder="Enter your email"
                required
            >
        </div>

        <div class="mb-4">
            <label class="form-label">Password</label>
            <input
                type="password"
                name="password"
                class="form-control"
                placeholder="Enter your password"
                required
            >
        </div>

        <button type="submit" class="btn btn-teal w-100">
            Login
        </button>

    </form>

    <div class="text-center mt-4">
        <p class="mb-0">
            Don't have an account?
            <a href="<?= site_url('register') ?>">Register here</a>
        </p>
    </div>

</div>

</body>
</html>
