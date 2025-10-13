<?php
session_start();
include '../config/database.php';
include '../partials/header.php';
include '../partials/sidebar.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}

// ===== CREATE USER =====
if (isset($_POST['create'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO users (nama, username, password, role) VALUES ('$nama','$username','$password','user_rba')");
    echo "<script>alert('User berhasil ditambahkan!'); window.location='user.php';</script>";
}

// ===== DELETE USER =====
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM users WHERE id_user=$id");
    echo "<script>alert('User berhasil dihapus!'); window.location='user.php';</script>";
}

// ===== GET USER DATA =====
$result = mysqli_query($conn, "SELECT * FROM users WHERE role='user_rba'");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data User RBA</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body style="background-color: #f3f6fa;">
<div class="container-fluid mt-4">
  <div class="card shadow-lg border-0">
    <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
      <h4 class="mb-0"><i class="bi bi-people-fill"></i> Data User RBA</h4>
      <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#createUser">
        ➕ Tambah User
      </button>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead class="table-primary text-center">
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Username</th>
              <th>Role</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; while($u=mysqli_fetch_assoc($result)): ?>
              <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= htmlspecialchars($u['nama']); ?></td>
                <td><?= htmlspecialchars($u['username']); ?></td>
                <td class="text-center"><span class="badge bg-success"><?= strtoupper($u['role']); ?></span></td>
                <td class="text-center">
                  <a href="detailuser.php?id=<?= $u['id_user'] ?>" class="btn btn-sm btn-outline-info">
                    <i class="bi bi-eye"></i> Detail
                  </a>
                  <a href="?delete=<?= $u['id_user'] ?>" onclick="return confirm('Yakin hapus user ini?')" 
                     class="btn btn-sm btn-outline-danger">
                     <i class="bi bi-trash"></i> Hapus
                  </a>
                </td>
              </tr>
            <?php endwhile; ?>
            <?php if(mysqli_num_rows($result) == 0): ?>
              <tr><td colspan="5" class="text-center text-muted">Belum ada data user</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Create User -->
<div class="modal fade" id="createUser" tabindex="-1" aria-labelledby="createUserLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" class="modal-content shadow">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="createUserLabel">Tambah User Baru</h5>
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
        <button type="submit" name="create" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/main.js"></script>
</body>
</html>
