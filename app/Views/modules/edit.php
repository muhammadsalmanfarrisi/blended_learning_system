<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Module</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Edit Module</h1>
        <form action="/modules/update/<?= $module['id'] ?>" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="<?= $module['title'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4" required><?= $module['description'] ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Module</button>
            <a href="/modules" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>