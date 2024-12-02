<?= view('layout/header'); ?>
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Edit User</h3>
            <a href="<?= base_url('users') ?>" class="btn btn-light btn-sm">Kembali</a>
        </div>
        <div class="card-body">
            <form action="<?= base_url('users/update/' . $user['id']) ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" value="<?= old('email', $user['email']) ?>"
                        class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" value="<?= old('username', $user['username']) ?>"
                        class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                </div>
                <div class="form-group mb-4">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" class="form-control">
                        <?php foreach ($groups as $group): ?>
                            <option value="<?= $group['id'] ?>"
                                <?= $user['role_id'] == $group['id'] ? 'selected' : '' ?>>
                                <?= $group['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="<?= base_url('users') ?>" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>