<?php
session_start();
if(!isset($_SESSION['id_user'])) {
  header("Location: ../login.php");
  exit;
}
include '../config/database.php';
include '../partials/header.php';
include '../partials/sidebar.php';

// Hitung total data
$totalUser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users WHERE role='user_rba'"))['total'];
$totalSupplier = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users WHERE role='supplier'"))['total'];
$totalRAB = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM rab"))['total'];
$totalMaterial = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM material"))['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - Sistem RAB</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.js"></script>
</head>
<body style="background-color: #f3f6fa;">
<div class="container mt-4">
  
  <!-- Header -->
  <div class="card border-0 shadow-sm mb-4" style="background: linear-gradient(90deg, #0d6efd, #1e90ff); color:white;">
    <div class="card-body d-flex justify-content-between align-items-center">
      <div>
        <h3 class="fw-bold mb-0">Selamat Datang, <?= htmlspecialchars($_SESSION['nama']); ?> 👋</h3>
        <small>Role kamu: <strong><?= strtoupper($_SESSION['role']); ?></strong></small>
      </div>
      <i class="bi bi-person-circle fs-1"></i>
    </div>
  </div>

  <!-- Statistik Card -->
  <div class="row g-4">
    <div class="col-md-3 col-sm-6">
      <div class="card border-0 shadow-sm h-100 hover-card">
        <div class="card-body text-center">
          <i class="bi bi-people-fill text-primary fs-1 mb-2"></i>
          <h5 class="fw-bold">User</h5>
          <p class="display-6 fw-bold text-primary"><?= $totalUser ?></p>
          <a href="user.php" class="btn btn-outline-primary btn-sm">Kelola User</a>
        </div>
      </div>
    </div>

    <div class="col-md-3 col-sm-6">
      <div class="card border-0 shadow-sm h-100 hover-card">
        <div class="card-body text-center">
          <i class="bi bi-building text-success fs-1 mb-2"></i>
          <h5 class="fw-bold">Supplier</h5>
          <p class="display-6 fw-bold text-success"><?= $totalSupplier ?></p>
          <a href="supplier.php" class="btn btn-outline-success btn-sm">Kelola Supplier</a>
        </div>
      </div>
    </div>

    <div class="col-md-3 col-sm-6">
      <div class="card border-0 shadow-sm h-100 hover-card">
        <div class="card-body text-center">
          <i class="bi bi-clipboard-data text-warning fs-1 mb-2"></i>
          <h5 class="fw-bold">RAB</h5>
          <p class="display-6 fw-bold text-warning"><?= $totalRAB ?></p>
          <a href="../rab/rab.php" class="btn btn-outline-warning btn-sm">Lihat RAB</a>
        </div>
      </div>
    </div>

    <div class="col-md-3 col-sm-6">
      <div class="card border-0 shadow-sm h-100 hover-card">
        <div class="card-body text-center">
          <i class="bi bi-box-seam text-danger fs-1 mb-2"></i>
          <h5 class="fw-bold">Material</h5>
          <p class="display-6 fw-bold text-danger"><?= $totalMaterial ?></p>
          <a href="material.php" class="btn btn-outline-danger btn-sm">Lihat Material</a>
        </div>
      </div>
    </div>
  </div>

</div>

<style>
.hover-card {
  transition: transform .2s, box-shadow .2s;
}
.hover-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 0 15px rgba(0,0,0,0.1);
}
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
