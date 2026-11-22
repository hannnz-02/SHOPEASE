
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= esc($title ?? 'ShopEase - Electronics Store') ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

    <style>
        /* NAVBAR ACCOUNT */
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .account-dropdown .account-button {
            background: #17645F;
            color: white;
            border: none;
            border-radius: 30px;
            padding: 9px 17px;
            font-size: 14px;
            font-weight: 600;
            transition: .3s;
        }

        .account-dropdown .account-button:hover {
            background: #247F79;
            color: white;
        }

        .account-dropdown .dropdown-menu {
            min-width: 220px;
            border: none;
            border-radius: 12px;
            padding: 8px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .12);
        }

        .account-dropdown .dropdown-item {
            padding: 10px 12px;
            border-radius: 7px;
            font-size: 14px;
        }

        .account-dropdown .dropdown-item:hover {
            background: #DDF2ED;
            color: #17645F;
        }

        .account-dropdown .dropdown-item.text-danger:hover {
            background: #fff0f0;
            color: #dc3545 !important;
        }

        .account-role {
            font-size: 12px;
            color: #777;
            padding: 8px 12px;
        }

        @media (max-width: 991px) {
            .nav-actions {
                margin-top: 15px;
                padding-bottom: 15px;
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>

<?php
    $isLoggedIn = session()->get('isLoggedIn');
    $userName = session()->get('name');
    $userRole = session()->get('role');
?>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">

        <a class="navbar-brand" href="<?= base_url('/') ?>">
            <span class="brand-icon">
                <i class="bi bi-bag-heart-fill"></i>
            </span>
            ShopEase<span>.</span>
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarMenu"
            aria-controls="navbarMenu"
            aria-expanded="false"
            aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">

            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#home">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#categories">Categories</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#products">Products</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#about">About Us</a>
                </li>
            </ul>

            <div class="nav-actions">

                <a href="#products" class="nav-icon" aria-label="Search products">
                    <i class="bi bi-search"></i>
                </a>

                <a href="#products" class="nav-icon" aria-label="Wishlist">
                    <i class="bi bi-heart"></i>
                </a>

                <a href="#products" class="nav-icon cart-icon" aria-label="Shopping cart">
                    <i class="bi bi-bag"></i>
                    <span>0</span>
                </a>

                <?php if ($isLoggedIn): ?>

                    <!-- USER SUDAH LOGIN -->
                    <div class="dropdown account-dropdown">

                        <button
                            class="account-button dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">

                            <i class="bi bi-person-circle me-1"></i>
                            <?= esc($userName ?? 'Account') ?>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">

                            <li class="account-role">
                                Login sebagai:
                                <strong><?= esc(ucfirst($userRole ?? '')) ?></strong>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <?php if ($userRole === 'admin'): ?>

                                <li>
                                    <a class="dropdown-item" href="<?= site_url('admin') ?>">
                                        <i class="bi bi-speedometer2 me-2"></i>
                                        Admin Dashboard
                                    </a>
                                </li>

                            <?php elseif ($userRole === 'operator'): ?>

                                <li>
                                    <a class="dropdown-item" href="<?= site_url('operator') ?>">
                                        <i class="bi bi-speedometer2 me-2"></i>
                                        Operator Dashboard
                                    </a>
                                </li>

                            <?php elseif ($userRole === 'customer'): ?>

                                <li>
                                    <span class="dropdown-item-text">
                                        <i class="bi bi-person me-2"></i>
                                        Customer Account
                                    </span>
                                </li>

                            <?php endif; ?>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <form action="<?= site_url('logout') ?>" method="POST">
                                    <?= csrf_field() ?>

                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>
                                        Logout
                                    </button>
                                </form>
                            </li>

                        </ul>
                    </div>

                <?php else: ?>

                    <!-- USER BELUM LOGIN -->
                    <a href="<?= site_url('login') ?>" class="btn-login">
                        Login
                    </a>

                <?php endif; ?>

            </div>
        </div>
    </div>
</nav>


<!-- HERO SECTION -->
<section class="hero-section" id="home">
    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6 hero-content">

                <div class="hero-label">
                    <i class="bi bi-stars"></i>
                    Welcome to ShopEase
                </div>

                <h1>
                    Upgrade Your<br>
                    Digital Lifestyle<br>
                    <span>With ShopEase.</span>
                </h1>

                <p>
                    Temukan berbagai perangkat elektronik pilihan
                    untuk mendukung aktivitas dan gaya hidup digitalmu.
                </p>

                <div class="hero-buttons">

                    <a href="#products" class="btn-primary-custom">
                        Explore Products
                        <i class="bi bi-arrow-right"></i>
                    </a>

                    <a href="#categories" class="btn-secondary-custom">
                        View Categories
                    </a>

                </div>

                <div class="hero-stats">

                    <div>
                        <h3>500+</h3>
                        <p>Products</p>
                    </div>

                    <div>
                        <h3>1K+</h3>
                        <p>Customers</p>
                    </div>

                    <div>
                        <h3>100%</h3>
                        <p>Quality</p>
                    </div>

                </div>
            </div>

            <div class="col-lg-6">

                <div class="hero-image">

                    <div class="hero-circle"></div>

                    <img
                        src="<?= base_url('assets/images/hero-electronics.jpg') ?>"
                        alt="3D Electronics Collection">

                    <div class="floating-card">

                        <i class="bi bi-truck"></i>

                        <div>
                            <strong>Free Shipping</strong>
                            <small>For selected products</small>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</section>


<!-- BENEFITS SECTION -->
<section class="benefits-section">
    <div class="container">

        <div class="row g-4">

            <div class="col-md-4">
                <div class="benefit-card">

                    <div class="benefit-icon">
                        <i class="bi bi-truck"></i>
                    </div>

                    <div>
                        <h5>Free Shipping</h5>
                        <p>Pengiriman gratis untuk produk pilihan.</p>
                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="benefit-card">

                    <div class="benefit-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>

                    <div>
                        <h5>Secure Payment</h5>
                        <p>Transaksi aman dan mudah dilakukan.</p>
                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="benefit-card">

                    <div class="benefit-icon">
                        <i class="bi bi-headset"></i>
                    </div>

                    <div>
                        <h5>24/7 Support</h5>
                        <p>Layanan bantuan untuk setiap pelanggan.</p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>


<!-- CATEGORIES SECTION -->
<section class="section-padding" id="categories">
    <div class="container">

        <div class="section-heading">

            <div>
                <span class="section-label">OUR CATEGORIES</span>
                <h2>Explore by Category</h2>
                <p>Temukan perangkat yang sesuai dengan kebutuhanmu.</p>
            </div>

            <a href="#categories" class="view-all">
                View All
                <i class="bi bi-arrow-right"></i>
            </a>

        </div>

        <div class="row g-4">

            <div class="col-6 col-md-4 col-lg">
                <a href="#products" class="category-card">

                    <div class="category-image">
                        <img src="<?= base_url('assets/images/smartphone.png') ?>" alt="Smartphone">
                    </div>

                    <h5>Smartphones</h5>
                    <p>Explore Phones</p>

                </a>
            </div>

            <div class="col-6 col-md-4 col-lg">
                <a href="#products" class="category-card">

                    <div class="category-image">
                        <img src="<?= base_url('assets/images/laptop.png') ?>" alt="Laptop">
                    </div>

                    <h5>Laptops</h5>
                    <p>Explore Laptops</p>

                </a>
            </div>

            <div class="col-6 col-md-4 col-lg">
                <a href="#products" class="category-card">

                    <div class="category-image">
                        <img src="<?= base_url('assets/images/headphone.png') ?>" alt="Headphones">
                    </div>

                    <h5>Headphones</h5>
                    <p>Explore Audio</p>

                </a>
            </div>

            <div class="col-6 col-md-4 col-lg">
                <a href="#products" class="category-card">

                    <div class="category-image">
                        <img src="<?= base_url('assets/images/keyboard.png') ?>" alt="Keyboard">
                    </div>

                    <h5>Keyboards</h5>
                    <p>Explore Keyboards</p>

                </a>
            </div>

            <div class="col-6 col-md-4 col-lg">
                <a href="#products" class="category-card">

                    <div class="category-image">
                        <img src="<?= base_url('assets/images/mouse.png') ?>" alt="Mouse">
                    </div>

                    <h5>Accessories</h5>
                    <p>Explore Accessories</p>

                </a>
            </div>

        </div>
    </div>
</section>


<!-- PRODUCTS SECTION -->
<section class="section-padding products-section" id="products">
    <div class="container">

        <div class="section-heading">

            <div>
                <span class="section-label">OUR COLLECTION</span>
                <h2>Featured Products</h2>
                <p>Produk pilihan dengan kualitas terbaik.</p>
            </div>

            <a href="#products" class="view-all">
                View All
                <i class="bi bi-arrow-right"></i>
            </a>

        </div>

        <div class="row g-4">

            <?php
            $products = [
                [
                    'name' => 'Smartphone Pro X',
                    'category' => 'Smartphones',
                    'price' => 'Rp8.499.000',
                    'image' => 'product-phone1.png',
                    'rating' => '4.9'
                ],
                [
                    'name' => 'UltraBook Air',
                    'category' => 'Laptops',
                    'price' => 'Rp12.999.000',
                    'image' => 'product-laptop1.png',
                    'rating' => '4.8'
                ],
                [
                    'name' => 'Studio Headphones',
                    'category' => 'Audio',
                    'price' => 'Rp1.299.000',
                    'image' => 'product-headphone1.png',
                    'rating' => '4.9'
                ],
                [
                    'name' => 'Mechanical Keyboard',
                    'category' => 'Accessories',
                    'price' => 'Rp899.000',
                    'image' => 'product-keyboard1.png',
                    'rating' => '4.7'
                ]
            ];
            ?>

            <?php foreach ($products as $product): ?>

                <div class="col-6 col-lg-3">

                    <div class="product-card">

                        <div class="product-image">

                            <span class="product-badge">Popular</span>

                            <button class="wishlist-btn" type="button" aria-label="Add to wishlist">
                                <i class="bi bi-heart"></i>
                            </button>

                            <img
                                src="<?= base_url('assets/images/' . $product['image']) ?>"
                                alt="<?= esc($product['name']) ?>">

                        </div>

                        <div class="product-info">

                            <span class="product-category">
                                <?= esc($product['category']) ?>
                            </span>

                            <h5><?= esc($product['name']) ?></h5>

                            <div class="rating">
                                <i class="bi bi-star-fill"></i>
                                <?= esc($product['rating']) ?>
                            </div>

                            <div class="product-bottom">

                                <strong><?= esc($product['price']) ?></strong>

                                <button
                                    class="add-cart"
                                    type="button"
                                    aria-label="Add to cart">

                                    <i class="bi bi-plus-lg"></i>

                                </button>

                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>
    </div>
</section>


<!-- PROMO SECTION -->
<section class="promo-section" id="about">
    <div class="container">

        <div class="promo-content">

            <div>

                <span>EXCLUSIVE OFFER</span>

                <h2>Make Your Digital Life Better.</h2>

                <p>
                    Temukan teknologi terbaik untuk menemani setiap aktivitasmu.
                </p>

                <a href="#products" class="btn-promo">
                    Shop Now
                    <i class="bi bi-arrow-right"></i>
                </a>

            </div>

            <div class="promo-decoration">
                <i class="bi bi-lightning-charge-fill"></i>
            </div>

        </div>
    </div>
</section>


<!-- FOOTER -->
<footer class="footer">
    <div class="container">

        <div class="row g-4">

            <div class="col-lg-4">

                <a class="footer-brand" href="<?= base_url('/') ?>">
                    ShopEase<span>.</span>
                </a>

                <p class="footer-description">
                    Your trusted destination for modern electronics
                    and digital lifestyle products.
                </p>

                <div class="social-links">

                    <a href="#" aria-label="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>

                    <a href="#" aria-label="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>

                    <a href="#" aria-label="Twitter">
                        <i class="bi bi-twitter-x"></i>
                    </a>

                </div>
            </div>

            <div class="col-6 col-lg-2">

                <h5>Quick Links</h5>

                <a href="#home">Home</a>
                <a href="#categories">Categories</a>
                <a href="#products">Products</a>
                <a href="#about">About Us</a>

            </div>

            <div class="col-6 col-lg-3">

                <h5>Customer Service</h5>

                <a href="#">Contact Us</a>
                <a href="#">FAQ</a>
                <a href="#">Shipping Information</a>
                <a href="#">Return Policy</a>

            </div>

            <div class="col-lg-3">

                <h5>Contact</h5>

                <p>
                    <i class="bi bi-envelope"></i>
                    support@shopease.com
                </p>

                <p>
                    <i class="bi bi-telephone"></i>
                    +62 812 3456 7890
                </p>

                <p>
                    <i class="bi bi-geo-alt"></i>
                    Indonesia
                </p>

            </div>

        </div>

        <div class="footer-bottom">

            <p>
                &copy; <?= date('Y') ?> ShopEase. All rights reserved.
            </p>

            <p>
                Designed with
                <i class="bi bi-heart-fill"></i>
                for your digital lifestyle.
            </p>

        </div>

    </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
