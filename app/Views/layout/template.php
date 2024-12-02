<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blended_Learning_System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Custom Header Styles */
        .navbar {
            background-color: #004c8c;
            padding: 15px 20px;
        }

        .navbar-brand {
            font-size: 1.5rem;
            color: #fff;
            font-weight: bold;
        }

        .navbar-brand img {
            width: 40px;
            /* Adjusted size */
            height: 40px;
            /* Adjusted size */
            margin-right: 10px;
            /* Spacing between logo and text */
        }

        .navbar-nav .nav-link {
            color: #fff;
            margin-left: 15px;
            font-size: 1.1rem;
        }

        .navbar-nav .nav-link:hover {
            color: #ffd700;
        }

        .navbar-toggler-icon {
            background-color: #fff;
        }

        /* Custom Footer Styles */
        footer {
            background-color: #222;
            color: #fff;
            padding: 30px 0;
            text-align: center;
        }

        footer .footer-logo {
            width: 40px;
            /* Adjusted size */
            height: 40px;
            /* Adjusted size */
            margin-bottom: 10px;
        }

        footer .social-icons a {
            color: #fff;
            font-size: 1.5rem;
            margin: 0 10px;
            text-decoration: none;
        }

        footer .social-icons a:hover {
            color: #ffd700;
        }

        footer .footer-text {
            margin-top: 15px;
        }

        .navbar-brand {
            font-size: 1.25rem;
            color: #007BFF;
        }

        .navbar-brand:hover {
            color: #0056b3;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            color: #555;
        }

        .navbar-nav .nav-link:hover {
            color: #007BFF;
        }

        .btn-primary {
            background-color: #007BFF;
            border-color: #007BFF;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }



        .custom-navbar {
            background: linear-gradient(90deg, #003366, #0056b3);
            /* Gradient warna */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Bayangan */
            padding: 0.5rem 1rem;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .nav-link {
            font-weight: 500;
            color: rgba(255, 255, 255, 0.8);
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: #ffffff;
        }

        .navbar-toggler {
            border: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23ffffff' viewBox='0 0 30 30'%3E%3Cpath stroke='rgba%280, 0, 0, 0.55%29' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }

        .dropdown-menu {
            min-width: 200px;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .dropdown-menu a:hover {
            background-color: #0056b3;
            color: #fff;
        }

        .btn-light {
            color: #0056b3;
            border: 1px solid #fff;
        }

        .btn-light:hover {
            background-color: #fff;
            color: #0056b3;
        }

        /* Dropdown Styles */
        .dropdown-menu {
            width: 300px;
            /* Set dropdown width */
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            /* Shadow for modern look */
            overflow: hidden;
        }

        .dropdown-menu .dropdown-item {
            padding: 10px 15px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            transition: background-color 0.2s;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        .dropdown-menu .dropdown-item i {
            font-size: 1.2rem;
            color: #007BFF;
        }

        .dropdown-menu hr {
            margin: 0.5rem 0;
            border-top: 1px solid #dee2e6;
        }

        .dropdown-menu .text-danger {
            font-weight: bold;
        }

        .dropdown-menu .text-danger:hover {
            background-color: #f8d7da;
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="<?= base_url('images/logoLak.png'); ?>" alt="PKTJ Logo" class="img-fluid me-2" style="height: 40px; width: auto;">
                <span class="fw-bold text-white">Laksana Elevate</span>
            </a>
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/calendar/">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <?php if (in_groups('admin') || in_groups('Pelatih')) : ?>
                            <a class="nav-link text-white" href="/module/">Modul Pembelajaran</a>
                        <?php elseif (in_groups('Peserta Pelatihan')) : ?>
                            <a class="nav-link text-white" href="/modules_user/">Modul Pembelajaran</a>
                        <?php endif; ?>
                    </li>
                    <li class="nav-item">
                        <?php if (in_groups('admin') || in_groups('Pelatih')) : ?>
                            <a class="nav-link text-white" href="/rankings/">Ranking Pelatihan</a>
                        <?php elseif (in_groups('Peserta Pelatihan')) : ?>
                            <a class="nav-link text-white" href="/module/grafik/">Statistik</a>
                        <?php endif; ?>
                    </li>
                    <li class="nav-item">
                        <?php if (in_groups('admin')) : ?>
                            <a class="nav-link text-white" href="/admin/">User Profile</a>
                        <?php elseif (in_groups('Pelatih') || in_groups('Peserta Pelatihan')) : ?>
                            <a class="nav-link text-white" href="/user/">User Profile</a>
                        <?php endif; ?>
                    </li>

                </ul>
                <ul class="navbar-nav ms-auto">
                    <?php if (logged_in()) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center text-white" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?= base_url('uploads/foto/' . user()->user_image); ?>" alt="Profile" class="rounded-circle me-2" style="height: 40px; width: 40px;">
                                <span><?= user()->username; ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end p-3 shadow-lg" aria-labelledby="userDropdown">
                                <!-- Header -->
                                <div class="d-flex align-items-center mb-3">
                                    <img src="<?= base_url('uploads/foto/' . user()->user_image); ?>" alt="Profile" class="rounded-circle me-2" style="height: 50px; width: 50px;">
                                    <div>
                                        <h6 class="mb-0"><?= user()->username; ?></h6>
                                        <small class="text-muted"><?= user()->email; ?></small>
                                    </div>
                                </div>
                                <hr>
                                <!-- Menu Items -->
                                <li><a class="dropdown-item" href="/user"><i class="bi bi-person-circle me-2"></i> Lihat Data Diri</a></li>
                                <hr>
                                <li><a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                                        <a class="btn btn-primary" href="<?= base_url('logout'); ?>">Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php else : ?>
                        <li class="nav-item">
                            <a class="btn btn-primary me-2 px-4" href="/login">Login</a>
                            <a class="btn btn-outline-primary px-4" href="/register">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>



    <!-- Main Content -->
    <?= $this->renderSection('content'); ?>

    <!-- Footer Section -->
    <footer>
        <div class="container">
            <img src="<?= base_url('images/logoLak.png'); ?>" alt="PKTJ Logo" class="footer-logo" style="height: 80px; max-height: none; width: auto;">
            <div class="social-icons">
                <a href="#" class="fa fa-facebook"></a>
                <a href="#" class="fa fa-twitter"></a>
                <a href="#" class="fa fa-instagram"></a>
                <a href="#" class="fa fa-linkedin"></a>
            </div>
            <div class="footer-text">
                <p>&copy; 2024 Laksana Elevate. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>

</html>