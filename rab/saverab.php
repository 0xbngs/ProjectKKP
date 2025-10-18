<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['id_user'])) {
  header("Location: ../login.php");
  exit;
}

$id_user = $_SESSION['id_user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // ========== AMBIL DATA UTAMA ==========
  $project_name = mysqli_real_escape_string($conn, $_POST['project_name']);
  $type         = mysqli_real_escape_string($conn, $_POST['type']);
  $location     = mysqli_real_escape_string($conn, $_POST['location']);
  $unit         = intval($_POST['unit'] ?? 1);
  $notes        = mysqli_real_escape_string($conn, $_POST['notes'] ?? '');

  // ========== BUAT ID RAB UNIK ==========
  $id_rab = uniqid('RAB-');

  // ========== INSERT DATA RAB KE DATABASE ==========
  $query_rab = "
      INSERT INTO rab (id_rab, id_user, project_name, unit, type, location, notes, jumlahTotal, pembulatan, permeterpersegi)
      VALUES ('$id_rab', '$id_user', '$project_name', '$unit', '$type', '$location', '$notes', 0, 0, 0)
  ";
  $result_rab = mysqli_query($conn, $query_rab);
  if (!$result_rab) {
      die('❌ Gagal insert data RAB utama: ' . mysqli_error($conn));
  }

  // ========== PROSES DATA DETAIL ==========
  $totalKeseluruhan = 0;

  // --- Gabungkan kategori dari Budget & Additional ---
  $allCategories = [];

  if (isset($_POST['category']['budget'])) {
      foreach ($_POST['category']['budget'] as $c) {
          $allCategories[] = $c;
      }
  }
  if (isset($_POST['category']['additional'])) {
      foreach ($_POST['category']['additional'] as $c) {
          $allCategories[] = $c;
      }
  }

  // --- Loop setiap kategori & material ---
  foreach ($allCategories as $catData) {
      $categoryName = mysqli_real_escape_string($conn, $catData['name'] ?? '');
      if (empty($catData['materials'])) continue;

      foreach ($catData['materials'] as $mat) {
          $matName = mysqli_real_escape_string($conn, $mat['material_name'] ?? '');
          $unitVal = mysqli_real_escape_string($conn, $mat['unit'] ?? '');
          $qty     = intval($mat['quantity'] ?? 0);
          $unitP   = intval($mat['unit_price'] ?? 0);
          $totalC  = intval($mat['total_cost'] ?? 0);

          if (empty($matName)) continue;

          $query_detail = "
              INSERT INTO rab_detail (id_rab, category, material_name, unit, quantity, unitPrice, totalCost)
              VALUES ('$id_rab', '$categoryName', '$matName', '$unitVal', '$qty', '$unitP', '$totalC')
          ";

          $result_detail = mysqli_query($conn, $query_detail);
          if (!$result_detail) {
              echo '⚠ Gagal insert detail: ' . mysqli_error($conn) . '<br>';
          }

          $totalKeseluruhan += $totalC;
      }
  }

  // ========== HITUNG JUMLAH TOTAL, PEMBULATAN, PER METER PERSEGI ==========
  $jumlahTotal = $totalKeseluruhan;
  $pembulatan = round($jumlahTotal, -3); // pembulatan ke ribuan terdekat
  $permeterpersegi = 0;

  if (is_numeric($type) && $type > 0) {
      $permeterpersegi = $pembulatan / $type;
  }

  // ========== UPDATE NILAI DI TABEL RAB ==========
  $update = "
      UPDATE rab
      SET jumlahTotal = '$jumlahTotal',
          pembulatan = '$pembulatan',
          permeterpersegi = '$permeterpersegi'
      WHERE id_rab = '$id_rab'
  ";
  mysqli_query($conn, $update);

  // ========== FEEDBACK ==========
  echo "<script>
      alert('✅ RAB berhasil disimpan!');
      window.location='rab.php';
  </script>";
  exit;

} else {
  echo "<script>alert('Akses tidak valid!'); window.location='rab.php';</script>";
  exit;
}
?>
