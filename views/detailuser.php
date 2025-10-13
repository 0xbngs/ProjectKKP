<?php
session_start();
include '../config/database.php';
include '../partials/header.php';
include '../partials/sidebar.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id_user='$id'"));
if (!$user) {
    echo "<script>alert('User tidak ditemukan!'); window.location='user.php';</script>";
    exit;
}

// Update data
if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'] ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    if ($password) {
        mysqli_query($conn, "UPDATE users SET nama='$nama', username='$username', password='$password' WHERE id_user='$id'");
    } else {
        mysqli_query($conn, "UPDATE users SET nama='$nama', username='$username' WHERE id_user='$id'");
    }

    echo "<script>alert('Data user berhasil diperbarui!'); window.location='detailuser.php?id=$id';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body style="background-color:#f3f6fa;">
<div class="container mt-4">
  <div class="card shadow border-0">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="bi bi-person-circle"></i> Detail User</h5>
      <a href="user.php" class="btn btn-light btn-sm"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-5">
          <table class="table table-borderless">
            <tr><th>ID User</th><td><?= $user['id_user'] ?></td></tr>
            <tr><th>Nama</th><td><?= htmlspecialchars($user['nama']) ?></td></tr>
            <tr><th>Username</th><td><?= htmlspecialchars($user['username']) ?></td></tr>
            <tr><th>Role</th><td><span class="badge bg-success"><?= strtoupper($user['role']) ?></span></td></tr>
          </table>
        </div>

        <div class="col-md-7 border-start">
          <h6 class="fw-bold text-primary mb-3">✏️ Edit Data User</h6>
          <form method="POST">
            <div class="mb-3">
              <label class="form-label">Nama Lengkap</label>
              <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($user['nama']) ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Username</label>
              <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Password (kosongkan jika tidak diubah)</label>
              <input type="password" name="password" class="form-control" placeholder="••••••••">
            </div>
            <button type="submit" name="update" class="btn btn-primary"><i class="bi bi-save"></i> Simpan Perubahan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
