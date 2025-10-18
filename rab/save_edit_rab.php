<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['id_user'])) {
  header("Location: ../login.php");
  exit;
}

$id_user = $_SESSION['id_user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $old_id_rab = mysqli_real_escape_string($conn, $_POST['old_id_rab']);
  $parent_id  = mysqli_real_escape_string($conn, $_POST['parent_id']);

  $project_name = mysqli_real_escape_string($conn, $_POST['project_name']);
  $type         = mysqli_real_escape_string($conn, $_POST['type']);
  $location     = mysqli_real_escape_string($conn, $_POST['location']);
  $unit         = intval($_POST['unit'] ?? 1);
  $notes        = mysqli_real_escape_string($conn, $_POST['notes'] ?? '');

  $new_id = $old_id_rab . '-REV-' . date('Ymd-His');
  $totalKeseluruhan = 0;

  // Buat RAB baru
  $insert_rab = "
      INSERT INTO rab (id_rab, parent_id, id_user, project_name, unit, type, location, notes, jumlahTotal, pembulatan, permeterpersegi)
      VALUES ('$new_id', '$parent_id', '$id_user', '$project_name', '$unit', '$type', '$location', '$notes', 0, 0, 0)
  ";
  mysqli_query($conn, $insert_rab);

  // Ambil kategori dari POST (Budget + Additional)
  $categories = $_POST['category'] ?? [];
  foreach ($categories as $group => $groupData) {
    foreach ($groupData as $cat) {
      $category_name = mysqli_real_escape_string($conn, $cat['name']);
      foreach ($cat['materials'] ?? [] as $mat) {
        $mat_name = mysqli_real_escape_string($conn, $mat['material_name']);
        $unitVal  = mysqli_real_escape_string($conn, $mat['unit']);
        $qty      = floatval($mat['quantity'] ?? 0);
        $price    = floatval($mat['unit_price'] ?? 0);
        $total    = $qty * $price;
        $totalKeseluruhan += $total;

        mysqli_query($conn, "
          INSERT INTO rab_detail (id_rab, category, material_name, unit, quantity, unitPrice, totalCost)
          VALUES ('$new_id', '$category_name', '$mat_name', '$unitVal', '$qty', '$price', '$total')
        ");
      }
    }
  }

  // Update total akhir
  $pembulatan = round($totalKeseluruhan, -3);
  $permeterpersegi = ($type > 0) ? $pembulatan / $type : 0;
  mysqli_query($conn, "
      UPDATE rab SET jumlahTotal='$totalKeseluruhan', pembulatan='$pembulatan', permeterpersegi='$permeterpersegi'
      WHERE id_rab='$new_id'
  ");

  echo "<script>alert('✅ Versi baru RAB berhasil disimpan!'); window.location='detailrab.php?id=$new_id';</script>";
  exit;
}
?>
