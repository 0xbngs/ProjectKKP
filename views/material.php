<?php
session_start();
include '../config/database.php';
include '../partials/header.php';
include '../partials/sidebar.php';

if (!isset($_SESSION['id_user'])) {
  header("Location: ../login.php");
  exit;
}

$id_user = $_SESSION['id_user'];
$role = $_SESSION['role'];

// === CREATE MATERIAL ===
if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $spec = $_POST['specification'];
    $unit = $_POST['unit'];
    $qty  = $_POST['quantity'];
    $price = $_POST['price'];

    mysqli_query($conn, "INSERT INTO material (id_user,name,specification,unit,quantity,price) 
                         VALUES ('$id_user','$name','$spec','$unit','$qty','$price')");
    echo "<script>alert('Material berhasil ditambahkan!'); window.location='material.php';</script>";
}

// === DELETE MATERIAL ===
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM material WHERE id_material=$id");
    echo "<script>alert('Material berhasil dihapus!'); window.location='material.php';</script>";
}

// === FETCH DATA ===
$result = mysqli_query($conn, "SELECT * FROM material ORDER BY id_material DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Material</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body style="background-color:#f3f6fa;">
<div class="container-fluid mt-4">
  <div class="card shadow-lg border-0">
    <div class="card-header bg-purple text-white d-flex justify-content-between align-items-center" style="background: linear-gradient(90deg,#6610f2,#6f42c1);">
      <h4 class="mb-0"><i class="bi bi-box-seam"></i> Data Material</h4>
      <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#createMaterial">
        ➕ Tambah Material
      </button>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead class="table-secondary text-center">
            <tr>
              <th>No</th>
              <th>Nama Material</th>
              <th>Spesifikasi</th>
              <th>Satuan</th>
              <th>Qty</th>
              <th>Harga</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; while($m=mysqli_fetch_assoc($result)): ?>
              <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= htmlspecialchars($m['name']) ?></td>
                <td><?= htmlspecialchars($m['specification']) ?></td>
                <td class="text-center"><?= htmlspecialchars($m['unit']) ?></td>
                <td class="text-center"><?= number_format($m['quantity']) ?></td>
                <td class="text-end">Rp <?= number_format($m['price']) ?></td>
                <td class="text-center">
                  <a href="detailmaterial.php?id=<?= $m['id_material'] ?>" class="btn btn-sm btn-outline-info">
                    <i class="bi bi-eye"></i> Detail
                  </a>
                  <a href="?delete=<?= $m['id_material'] ?>" onclick="return confirm('Yakin hapus material ini?')" class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-trash"></i> Hapus
                  </a>
                </td>
              </tr>
            <?php endwhile; ?>
            <?php if(mysqli_num_rows($result)==0): ?>
              <tr><td colspan="7" class="text-center text-muted">Belum ada data material</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Create Material -->
<div class="modal fade" id="createMaterial" tabindex="-1" aria-labelledby="createMaterialLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" class="modal-content shadow">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="createMaterialLabel">Tambah Material Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Nama Material</label>
          <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Spesifikasi</label>
          <textarea name="specification" class="form-control"></textarea>
        </div>
        <div class="row">
          <div class="col-md-4 mb-3">
            <label class="form-label">Satuan</label>
            <input type="text" name="unit" class="form-control" required>
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label">Jumlah</label>
            <input type="number" name="quantity" class="form-control" required>
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label">Harga (Rp)</label>
            <input type="number" name="price" class="form-control" required>
          </div>
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
</body>
</html>
