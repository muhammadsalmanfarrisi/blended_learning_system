<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="<?= base_url(); ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="h3 mb-4 text-gray-800">Edit Profile</h1>
        <form action="<?= base_url('user/update/' . user()->id); ?>" method="post" enctype="multipart/form-data">

            <?= csrf_field(); ?>
            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= esc($user->email); ?>" readonly>
            </div>

            <!-- Username -->
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= esc($user->username); ?>" readonly>
            </div>

            <!-- Full Name -->
            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="<?= esc($user->fullname); ?>" required>
            </div>

            <!-- Jenis Kelamin -->
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki-laki" <?= $user->jenis_kelamin === 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
                    <option value="Perempuan" <?= $user->jenis_kelamin === 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                </select>
            </div>

            <!-- Tanggal Lahir -->
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= esc($user->tanggal_lahir); ?>" required>
            </div>

            <!-- Agama -->
            <div class="form-group">
                <label for="agama">Agama</label>
                <input type="text" class="form-control" id="agama" name="agama" value="<?= esc($user->agama); ?>" required>
            </div>

            <!-- Divisi Kerja -->
            <div class="form-group">
                <label for="divisi_kerja">Divisi Kerja</label>
                <input type="text" class="form-control" id="divisi_kerja" name="divisi_kerja" value="<?= esc($user->divisi_kerja); ?>" required>
            </div>

            <!-- Jabatan -->
            <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= esc($user->jabatan); ?>" required>
            </div>

            <!-- Alamat -->
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" required><?= esc($user->alamat); ?></textarea>
            </div>

            <!-- Nomor Telepon -->
            <div class="form-group">
                <label for="nomor_telepon">Nomor Telepon</label>
                <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" value="<?= esc($user->nomor_telepon); ?>" required>
            </div>

            <!-- Tingkat Pendidikan Terakhir -->
            <div class="form-group">
                <label for="tingkat_pendidikan_terakhir">Tingkat Pendidikan Terakhir</label>
                <input type="text" class="form-control" id="tingkat_pendidikan_terakhir" name="tingkat_pendidikan_terakhir" value="<?= esc($user->tingkat_pendidikan_terakhir); ?>" required>
            </div>

            <!-- Jurusan Program Studi -->
            <div class="form-group">
                <label for="jurusan_program_studi">Jurusan Program Studi</label>
                <input type="text" class="form-control" id="jurusan_program_studi" name="jurusan_program_studi" value="<?= esc($user->jurusan_program_studi); ?>" required>
            </div>

            <!-- Pengalaman Kerja -->
            <div class="form-group">
                <label for="pengalaman_kerja">Pengalaman Kerja</label>
                <textarea class="form-control" id="pengalaman_kerja" name="pengalaman_kerja" required><?= esc($user->pengalaman_kerja); ?></textarea>
            </div>

            <!-- User Image -->
            <!-- <div class="form-group">
                <label for="user_image">Profile Image</label>
                <input type="file" class="form-control-file" id="user_image" name="user_image">
                <small class="form-text text-muted">Leave empty if you don't want to change the image.</small>
            </div> -->

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success">Save Changes</button>
            <a href="<?= base_url('user'); ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>