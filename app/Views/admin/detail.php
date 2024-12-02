<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>My Profile</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <?= view('layout/header'); ?>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <?php if (in_groups('admin')) : ?>
                <!-- Sidebar - Brand -->
                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Nav Item - Dashboard -->


                <!-- Heading -->
                <div class="sidebar-heading">
                    User Management
                </div>



                <!-- Nav Item - Utilities Collapse Menu -->


                <li class="nav-item">
                    <a class="nav-link" href="<?php base_url('/admin/index') ?>">
                        <i class="fas fa-users"></i>
                        <span>User List</span></a>
                </li>
            <?php endif; ?>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Dashboard -->


            <!-- Heading -->
            <div class="sidebar-heading">
                User Profile
            </div>



            <!-- Nav Item - Utilities Collapse Menu -->


            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/detail/' . user()->id); ?>">
                    <i class="fas fa-user"></i>
                    <span>My Profile</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-user-edit"></i>
                    <span>Edit Profile</span></a>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-sign-out-alt "></i>
                    <span>Logout</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">My Profile</h1>

                    <!-- Profile Card -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">User Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <img src="<?= base_url(); ?>/img/<?= user()->user_image; ?>" alt="Profile Image" class="img-fluid rounded-circle mb-3" style="max-width: 150px;">
                                </div>
                                <div class="col-md-8">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Email</th>
                                            <td><?= esc($user->email); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Username</th>
                                            <td><?= esc($user->username); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Full Name</th>
                                            <td><?= esc($user->fullname); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Kelamin</th>
                                            <td><?= esc($user->jenis_kelamin); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Lahir</th>
                                            <td><?= esc($user->tanggal_lahir); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Agama</th>
                                            <td><?= esc($user->agama); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Divisi Kerja</th>
                                            <td><?= esc($user->divisi_kerja); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Jabatan</th>
                                            <td><?= esc($user->jabatan); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td><?= esc($user->alamat); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Nomor Telepon</th>
                                            <td><?= esc($user->nomor_telepon); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tingkat Pendidikan Terakhir</th>
                                            <td><?= esc($user->tingkat_pendidikan_terakhir); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Jurusan Program Studi</th>
                                            <td><?= esc($user->jurusan_program_studi); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Pengalaman Kerja</th>
                                            <td><?= esc($user->pengalaman_kerja); ?></td>
                                        </tr>
                                    </table>
                                    <div class="text-right mb-3">
                                        <a href="<?= base_url('user/edit'); ?>" class="btn btn-primary">
                                            <i class="fas fa-edit"></i> Edit Profile
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('logout'); ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url(); ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(); ?>/js/sb-admin-2.min.js"></script>

</body>

</html>