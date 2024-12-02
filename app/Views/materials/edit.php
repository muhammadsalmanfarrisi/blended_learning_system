<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Material</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Material</h2>

    <form action="<?= base_url('/module/updateMaterial/' . $material['id']) ?>" method="post" enctype="multipart/form-data" class="p-4 border rounded bg-light shadow-sm">
        <input type="hidden" name="module_id" value="<?= $material['module_id'] ?>">

        <div class="mb-3">
            <label for="title" class="form-label">Judul Material</label>
            <input type="text" name="title" id="title" value="<?= esc($material['title']) ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">File Material (opsional)</label>
            <input type="file" name="file" id="file" class="form-control">
            <small class="form-text text-muted">File saat ini: <a href="<?= base_url($material['file_path']) ?>" target="_blank"><?= basename($material['file_path']) ?></a></small>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="<?= base_url('/module/view/' . $material['module_id']) ?>" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-pri
