<?php
session_start();
include '../config/database.php';
include '../partials/header.php';
include '../partials/sidebar.php';

if (!isset($_SESSION['id_user'])) {
  header("Location: ../login.php");
  exit;
}

$result = mysqli_query($conn, "SELECT * FROM rab ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data RAB</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body style="background-color:#f3f6fa;">
<div class="container-fluid mt-4">
  <div class="card shadow-lg border-0">
    <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
      <h4 class="mb-0"><i class="bi bi-journal-text"></i> Data Rencana Anggaran Biaya (RAB)</h4>
      <a href="createrab.php" class="btn btn-dark btn-sm">
        ➕ Buat RAB Baru
      </a>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead class="table-warning text-center">
            <tr>
              <th>No</th>
              <th>Nama Proyek</th>
              <th>Tipe</th>
              <th>Lokasi</th>
              <th>Unit</th>
              <th>Dibuat Oleh</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; while($r=mysqli_fetch_assoc($result)): ?>
              <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= htmlspecialchars($r['project_name']) ?></td>
                <td><?= htmlspecialchars($r['type']) ?></td>
                <td><?= htmlspecialchars($r['location']) ?></td>
                <td class="text-center"><?= $r['unit'] ?></td>
                <td class="text-center"><?= $r['id_user'] ?></td>
                <td class="text-center">
                  <a href="detailrab.php?id=<?= $r['id_rab'] ?>" class="btn btn-sm btn-outline-info">
                    <i class="bi bi-eye"></i> Detail
                  </a>
                  <a href="?delete=<?= $r['id_rab'] ?>" 
                     onclick="return confirm('Hapus RAB ini?')" 
                     class="btn btn-sm btn-outline-danger">
                     <i class="bi bi-trash"></i> Hapus
                  </a>
                </td>
              </tr>
            <?php endwhile; ?>
            <?php if(mysqli_num_rows($result) == 0): ?>
              <tr><td colspan="7" class="text-center text-muted">Belum ada RAB yang dibuat</td></tr>
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
