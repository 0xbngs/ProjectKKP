<?php
session_start();
include '../config/database.php';
include '../partials/header.php';
include '../partials/sidebar.php';

// Cek login
if (!isset($_SESSION['id_user'])) {
  header("Location: ../login.php");
  exit;
}

// Cek apakah ada parameter ID
if (!isset($_GET['id'])) {
  echo "<script>alert('ID RAB tidak ditemukan'); window.location='rab.php';</script>";
  exit;
}

$id_rab = mysqli_real_escape_string($conn, $_GET['id']);

// Ambil data RAB utama
$query_rab = mysqli_query($conn, "SELECT * FROM rab WHERE id_rab='$id_rab'");
if (!$query_rab || mysqli_num_rows($query_rab) == 0) {
  echo "<script>alert('Data RAB tidak ditemukan'); window.location='rab.php';</script>";
  exit;
}
$rab = mysqli_fetch_assoc($query_rab);

// Ambil data detail
$query_detail = mysqli_query($conn, "SELECT * FROM rab_detail WHERE id_rab='$id_rab' ORDER BY id ASC");

$totalKeseluruhan = 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail RAB</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body style="background-color:#f3f6fa;">
<div class="container mt-4">
  <div class="card shadow border-0 mb-4">
    <div class="card-header bg-warning d-flex justify-content-between align-items-center">
      <h5 class="mb-0 text-dark"><i class="bi bi-info-circle"></i> Detail RAB - <?= htmlspecialchars($rab['project_name']) ?></h5>
      <a href="rab.php" class="btn btn-dark btn-sm"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body">
      <div class="row mb-3">
        <div class="col-md-6">
          <table class="table table-sm table-borderless">
            <tr><th>ID RAB</th><td><?= htmlspecialchars($rab['id_rab']) ?></td></tr>
            <tr><th>Project Name</th><td><?= htmlspecialchars($rab['project_name']) ?></td></tr>
            <tr><th>Type</th><td><?= htmlspecialchars($rab['type']) ?></td></tr>
          </table>
        </div>
        <div class="col-md-6">
          <table class="table table-sm table-borderless">
            <tr><th>Location</th><td><?= htmlspecialchars($rab['location']) ?></td></tr>
            <tr><th>Unit</th><td><?= htmlspecialchars($rab['unit']) ?></td></tr>
            <tr><th>Tanggal Dibuat</th><td><?= htmlspecialchars($rab['created_at']) ?></td></tr>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- RAB Detail -->
  <div class="card shadow border-0">
    <div class="card-header bg-light">
      <h6 class="mb-0"><i class="bi bi-list-ul"></i> Rincian Anggaran Biaya</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
          <thead class="table-warning text-center">
            <tr>
              <th>No</th>
              <th>Kategori</th>
              <th>Nama Material</th>
              <th>Unit</th>
              <th>Quantity</th>
              <th>Harga Satuan (Rp)</th>
              <th>Total (Rp)</th>
            </tr>
          </thead>
          <tbody>
            <?php if (mysqli_num_rows($query_detail) > 0): ?>
              <?php $no=1; while ($d = mysqli_fetch_assoc($query_detail)): ?>
                <tr>
                  <td class="text-center"><?= $no++ ?></td>
                  <td><?= htmlspecialchars($d['category']) ?></td>
                  <td><?= htmlspecialchars($d['material_name']) ?></td>
                  <td class="text-center"><?= htmlspecialchars($d['unit']) ?></td>
                  <td class="text-center"><?= number_format($d['quantity']) ?></td>
                  <td class="text-end"><?= number_format($d['unitPrice']) ?></td>
                  <td class="text-end"><?= number_format($d['totalCost']) ?></td>
                </tr>
                <?php $totalKeseluruhan += $d['totalCost']; ?>
              <?php endwhile; ?>
              <tr class="table-warning fw-bold">
                <td colspan="6" class="text-end">Total Keseluruhan:</td>
                <td class="text-end">Rp <?= number_format($totalKeseluruhan) ?></td>
              </tr>
            <?php else: ?>
              <tr><td colspan="7" class="text-center text-muted">Belum ada data rincian untuk RAB ini</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
