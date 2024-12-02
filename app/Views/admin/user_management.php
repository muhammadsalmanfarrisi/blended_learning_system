<?= view('layout/header'); ?>
<div class="container mt-5">
    <h1 class="mb-4 text-center text-primary">Manage Users</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="/users/create" class="btn btn-success btn-lg">
            <i class="bi bi-person-plus"></i> Add User
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['username'] ?></td>
                        <td><?= $user['role'] ?? 'Tidak Ada' ?></td>
                        <td class="text-center">
                            <a href="/users/edit/<?= $user['id'] ?>" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <a href="/users/delete/<?= $user['id'] ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this user?')">
                                <i class="bi bi-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>