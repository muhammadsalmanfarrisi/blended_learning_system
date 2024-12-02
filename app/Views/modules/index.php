<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Header Section -->
<div class="card container-fluid bg-primary text-white py-5" style="background-image: url('<?= base_url('images/bg_modul.jpg'); ?>'); background-size: cover; background-position: center;">
    <div class="container text-center">
        <!-- Main Title Section with Subtle Text Shadow -->
        <h1 class="display-3 font-weight-bold mb-4" style="text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.6); background-color: rgba(0, 0, 0, 0.5); padding: 10px;">
            Modul Pembelajaran
        </h1>

        <!-- Subtitle Section with Subtle Text Shadow -->
        <p class="lead mb-4" style="font-size: 1.25rem; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.6); background-color: rgba(0, 0, 0, 0.5); padding: 8px;">
            Temukan dan pelajari modul yang tersedia
        </p>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-center">
            <a href="#modul" class="btn btn-light btn-lg mx-2" style="text-transform: uppercase; padding: 12px 30px; font-size: 1.1rem;">
                Lihat Modul
            </a>
            <a href="#modul" class="btn btn-secondary btn-lg mx-2" style="text-transform: uppercase; padding: 12px 30px; font-size: 1.1rem;">
                Mulai Belajar
            </a>
        </div>
    </div>
</div><br>


<div class="container text-center"><a href="<?= site_url('module/create'); ?>" class="btn btn-primary btn-lg me-2">Tambah Modul</a></div>

<!-- Tombol Edit dan Hapus, misalnya jika diperlukan di halaman ini -->
<!-- Modules Section -->
<div id="modul" class="container my-5">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($modules as $module): ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="<?= base_url('images/image2.png'); ?>" class="card-img-top" alt="Module Image">
                    <div class="card-body">
                        <h5 class="card-title"><?= $module['title']; ?></h5>
                        <p class="card-text">klik Lihat Modul untuk selengkapnya</p>
                    </div>
                    <div class="card-footer">
                        <a href="<?= site_url('module/view/' . $module['id']); ?>" class="btn btn-primary btn-sm">Lihat Modul</a>
                        <a href="/module/edit/<?= $module['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="/module/delete/<?= $module['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection(); ?>