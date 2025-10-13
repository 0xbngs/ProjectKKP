<?php
session_start();
include '../config/database.php';
include '../partials/header.php';
include '../partials/sidebar.php';

if (!isset($_SESSION['id_user'])) {
  header("Location: ../login.php");
  exit;
}

$id = $_GET['id'];
$material = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM material WHERE id_material='$id'"));
if (!$material) {
    echo "<script>alert('Material tidak ditemukan!'); window.location='material.php';</script>";
    exit;
}

// === UPDATE MATERIAL ===
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $spec = $_POST['specification'];
    $unit = $_POST['unit'];
    $qty  = $_POST['quantity'];
    $price = $_POST['price'];

    mysqli_query($conn, "UPDATE material SET name='$name', specification='$spec', unit='$unit', quantity='$qty', price='$price' WHERE id_material='$id'");
    echo "<script>alert('Material berhasil diperbarui!'); window.location='detailmaterial.php?id=$id';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Material</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body style="background-color:#f3f6fa;">
<div class="container mt-4">
  <div class="card shadow border-0">
    <div class="card-header bg-purple text-white d-flex justify-content-between align-items-center" style="background: linear-gradient(90deg,#6610f2,#6f42c1);">
      <h5 class="mb-0"><i class="bi bi-box-seam"></i> Detail Material</h5>
      <a href="material.php" class="btn btn-light btn-sm"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body">
      <div class="row">
        <!-- Left: Info -->
        <div class="col-md-5">
          <table class="table table-borderless">
            <tr><th>ID</th><td><?= $material['id_material'] ?></td></tr>
            <tr><th>Nama Material</th><td><?= htmlspecialchars($material['name']) ?></td></tr>
            <tr><th>Spesifikasi</th><td><?= htmlspecialchars($material['specification']) ?></td></tr>
            <tr><th>Satuan</th><td><?= htmlspecialchars($material['unit']) ?></td></tr>
            <tr><th>Jumlah</th><td><?= number_format($material['quantity']) ?></td></tr>
            <tr><th>Harga</th><td>Rp <?= number_format($material['price']) ?></td></tr>
          </table>
        </div>

        <!-- Right: Form Edit -->
        <div class="col-md-7 border-start">
          <h6 class="fw-bold text-primary mb-3">✏️ Edit Data Material</h6>
          <form method="POST">
            <div class="mb-3">
              <label class="form-label">Nama Material</label>
              <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($material['name']) ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Spesifikasi</label>
              <textarea name="specification" class="form-control"><?= htmlspecialchars($material['specification']) ?></textarea>
            </div>
            <div class="row">
              <div class="col-md-4 mb-3">
                <label class="form-label">Satuan</label>
                <input type="text" name="unit" class="form-control" value="<?= htmlspecialchars($material['unit']) ?>" required>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" name="quantity" class="form-control" value="<?= htmlspecialchars($material['quantity']) ?>" required>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Harga (Rp)</label>
                <input type="number" name="price" class="form-control" value="<?= htmlspecialchars($material['price']) ?>" required>
              </div>
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
