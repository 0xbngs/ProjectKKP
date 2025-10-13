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
$supplier = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id_user='$id' AND role='supplier'"));
if (!$supplier) {
    echo "<script>alert('Supplier tidak ditemukan!'); window.location='supplier.php';</script>";
    exit;
}

// === UPDATE SUPPLIER ===
if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'] ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    if ($password) {
        mysqli_query($conn, "UPDATE users SET nama='$nama', username='$username', password='$password' WHERE id_user='$id'");
    } else {
        mysqli_query($conn, "UPDATE users SET nama='$nama', username='$username' WHERE id_user='$id'");
    }

    echo "<script>alert('Data supplier berhasil diperbarui!'); window.location='detailsupplier.php?id=$id';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Supplier</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body style="background-color:#f3f6fa;">
<div class="container mt-4">
  <div class="card shadow border-0">
    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="bi bi-truck"></i> Detail Supplier</h5>
      <a href="supplier.php" class="btn btn-light btn-sm"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-5">
          <table class="table table-borderless">
            <tr><th>ID Supplier</th><td><?= $supplier['id_user'] ?></td></tr>
            <tr><th>Nama</th><td><?= htmlspecialchars($supplier['nama']) ?></td></tr>
            <tr><th>Username</th><td><?= htmlspecialchars($supplier['username']) ?></td></tr>
            <tr><th>Role</th><td><span class="badge bg-success"><?= strtoupper($supplier['role']) ?></span></td></tr>
          </table>
        </div>

        <div class="col-md-7 border-start">
          <h6 class="fw-bold text-success mb-3">✏️ Edit Data Supplier</h6>
          <form method="POST">
            <div class="mb-3">
              <label class="form-label">Nama Lengkap</label>
              <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($supplier['nama']) ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Username</label>
              <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($supplier['username']) ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Password (kosongkan jika tidak diubah)</label>
              <input type="password" name="password" class="form-control" placeholder="••••••••">
            </div>
            <button type="submit" name="update" class="btn btn-success"><i class="bi bi-save"></i> Simpan Perubahan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
