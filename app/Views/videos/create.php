<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Video</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Tambah Video</h2>

        <form action="/module/storeVideo" method="post" enctype="multipart/form-data" class="p-4 border rounded bg-light shadow-sm">
            <input type="hidden" name="module_id" value="<?= $module_id ?>">

            <div class="mb-3">
                <label for="title" class="form-label">Judul Video</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Upload Video</label>
                <input type="file" name="file" id="file" class="form-control" accept="video/mp4, video/avi, video/mkv" required>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="<?= base_url('/module/view/' . $module_id) ?>" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Add Video</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>