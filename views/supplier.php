<?php
session_start();
include '../config/database.php';
include '../partials/header.php';
include '../partials/sidebar.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}

// === CREATE SUPPLIER ===
if (isset($_POST['create'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO users (nama, username, password, role) VALUES ('$nama','$username','$password','supplier')");
    echo "<script>alert('Supplier berhasil ditambahkan!'); window.location='supplier.php';</script>";
}

// === DELETE SUPPLIER ===
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM users WHERE id_user=$id");
    echo "<script>alert('Supplier berhasil dihapus!'); window.location='supplier.php';</script>";
}

// === FETCH SUPPLIER DATA ===
$result = mysqli_query($conn, "SELECT * FROM users WHERE role='supplier'");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Supplier</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body style="background-color: #f3f6fa;">
<div class="container-fluid mt-4">
  <div class="card shadow-lg border-0">
    <div class="card-header d-flex justify-content-between align-items-center bg-success text-white">
      <h4 class="mb-0"><i class="bi bi-truck"></i> Data Supplier</h4>
      <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#createSupplier">
        ➕ Tambah Supplier
      </button>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead class="table-success text-center">
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Username</th>
              <th>Role</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; while($s=mysqli_fetch_assoc($result)): ?>
              <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= htmlspecialchars($s['nama']); ?></td>
                <td><?= htmlspecialchars($s['username']); ?></td>
                <td class="text-center"><span class="badge bg-success"><?= strtoupper($s['role']); ?></span></td>
                <td class="text-center">
                  <a href="detailsupplier.php?id=<?= $s['id_user'] ?>" class="btn btn-sm btn-outline-info">
                    <i class="bi bi-eye"></i> Detail
                  </a>
                  <a href="?delete=<?= $s['id_user'] ?>" onclick="return confirm('Yakin ingin menghapus supplier ini?')" 
                     class="btn btn-sm btn-outline-danger">
                     <i class="bi bi-trash"></i> Hapus
                  </a>
                </td>
              </tr>
            <?php endwhile; ?>
            <?php if(mysqli_num_rows($result) == 0): ?>
              <tr><td colspan="5" class="text-center text-muted">Belum ada data supplier</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Create Supplier -->
<div class="modal fade" id="createSupplier" tabindex="-1" aria-labelledby="createSupplierLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" class="modal-content shadow">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="createSupplierLabel">Tambah Supplier Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Nama Lengkap</label>
          <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" name="create" class="btn btn-success">Simpan</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/main.js"></script>
</body>
</html>
