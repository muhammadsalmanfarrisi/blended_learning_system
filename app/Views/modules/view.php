<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="card container-fluid bg-primary text-white py-5" style="background-image: url('<?= base_url('images/bg_modul.jpg'); ?>'); background-size: cover; background-position: center;">
    <div class="container text-center">
        <!-- Main Title Section with Subtle Text Shadow -->
        <h1 class="display-3 font-weight-bold mb-4" style="text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.6); background-color: rgba(0, 0, 0, 0.5); padding: 10px;">
            <?= $module['title']; ?>
        </h1>
        <!-- Subtitle Section with Subtle Text Shadow -->
        <p class="lead mb-4" style="font-size: 1.25rem; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.6); background-color: rgba(0, 0, 0, 0.5); padding: 8px;">
            Pelajari Materi, Video, dan Kerjakan Pretest
        </p>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-center flex-column flex-md-row">
            <a href="#video" class="btn btn-light btn-lg mx-2 mb-2 mb-md-0" style="text-transform: uppercase; padding: 12px 30px; font-size: 1.1rem;">
                Lihat Vidio Pembelajaran
            </a>
            <a href="#materi" class="btn btn-secondary btn-lg mx-2 mb-2 mb-md-0" style="text-transform: uppercase; padding: 12px 30px; font-size: 1.1rem;">
                Lihat Materi Pembelajaran
            </a>
            <a href="<?= site_url('module'); ?>" class="btn btn-danger btn-lg mx-2" style="text-transform: uppercase; padding: 12px 30px; font-size: 1.1rem;">
                Kembali
            </a>
        </div>
    </div>
</div><br>


<!-- Modul Detail Section -->
<div class="container my-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Deskripsi Modul</h5>
                    <p class="card-text"><?= $module['description']; ?></p>

                    <!-- Menampilkan Materi (PDF atau Video) -->
                    <h3>Daftar Vidio Pembelajaran</h3>
                    <div class="container text-center">
                        <a href="/module/addVideo/<?= $module['id'] ?> " class="btn btn-primary btn-lg me-2">Add New Video</a>
                    </div>
                    <br><br>
                    <div id="video" class="row">
                        <?php foreach ($videos as $video): ?>
                            <div class="col-12 mb-4"> <!-- Menggunakan col-12 untuk lebar penuh -->
                                <div class="card shadow-sm h-100">
                                    <div class="card-header">
                                        <h5 class="card-title"><?= $video['title'] ?></h5>
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <?php if ($video['file_path']): ?>
                                            <!-- Cek apakah file adalah video, jika ya, tampilkan video player -->
                                            <?php
                                            $fileExt = pathinfo($video['file_path'], PATHINFO_EXTENSION);
                                            if (in_array(strtolower($fileExt), ['mp4', 'webm', 'ogg', 'mov'])):
                                            ?>
                                                <video class="w-100" controls style="height: 600px;"> <!-- Menambah tinggi video -->
                                                    <source src="<?= base_url($video['file_path']) ?>" type="video/<?= $fileExt ?>">
                                                    Your browser does not support the video tag.
                                                </video>
                                            <?php else: ?>
                                                <a href="<?= base_url($video['file_path']) ?>" target="_blank" class="btn btn-success w-100 mt-3"><?= $video['title'] ?> (View)</a>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <p class="text-muted">No video file available</p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-footer text-muted d-flex justify-content-between">
                                        <a href="/module/editVideo/<?= $video['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="/module/deleteVideo/<?= $video['id'] ?>" onclick="return confirm('Are you sure you want to delete this video?')" class="btn btn-danger btn-sm">Delete</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>


                    <h3>Daftar Materi</h3>
                    <div class="container text-center"><a href="<?= base_url('module/addMaterial/' . $module['id']) ?>" class="btn btn-primary btn-lg me-2">Tambah Materi</a>

                    </div>
                    <br><br>
                    <div id="materi" class="row">
                        <?php foreach ($materials as $material): ?>
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title"><?= $material['title'] ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <img src="<?= base_url('images/buku.png') ?>" alt="PDF Icon" class="img-fluid mb-3 d-block mx-auto mb-3" style="width: 200px; height: 150px;">
                                        <?php if ($material['file_path']): ?>
                                            <a href="<?= base_url($material['file_path']) ?>" target="_blank" class="btn btn-success"><i class="bi bi-file-earmark-pdf-fill me-2"></i>Lihat Materi</a>
                                        <?php else: ?>
                                            <p class="text-muted">No PDF file available</p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-footer text-muted">
                                        <a href="<?= base_url('module/editMaterial/' . $material['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="<?= base_url('module/deleteMaterial/' . $material['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus materi ini?')">Hapus</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>




                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">Pretest</h3>
                    <!-- Tombol Edit dan Hapus Modul -->
                    <h4>Kerjakan Soal Pretest Berikut Ini:</h4>
                    <!-- <a href="<?= site_url('module/pretest/' . $module['id']) ?>" class="btn btn-warning btn-block mb-3">Start Pretest</a> -->
                    <a href="<?= site_url('question/index/' . $module['id']) ?>" class="btn btn-secondary">Manage Questions & Answers</a>

                    <!-- <a href="<?= site_url('module/delete/' . $module['id']); ?>" class="btn btn-danger btn-block" onclick="return confirm('Apakah Anda yakin ingin menghapus modul ini?')">Hapus Modul</a> -->
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>