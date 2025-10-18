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
    $unit         = intval($_POST['unit']);
    $notes        = mysqli_real_escape_string($conn, $_POST['notes'] ?? '');
    $additional   = mysqli_real_escape_string($conn, $_POST['additional_info'] ?? '');

    // ========== BUAT ID RAB UNIK ==========
    $id_rab = uniqid('RAB-');

    // ========== INSERT KE TABEL RAB ==========
    $query_rab = "
        INSERT INTO rab (id_rab, id_user, project_name, unit, type, location, jumlahTotal, pembulatan, permeterpersegi, notes, additional_info)
        VALUES ('$id_rab', '$id_user', '$project_name', '$unit', '$type', '$location', 0, 0, 0, '$notes', '$additional')
    ";
    $result_rab = mysqli_query($conn, $query_rab);

    if (!$result_rab) {
        die('❌ Gagal insert data RAB utama: ' . mysqli_error($conn));
    }

    // ========== INSERT KE TABEL RAB_DETAIL ==========
    if (!empty($_POST['material_name'])) {

        $categories = $_POST['category'];        // Array kategori per baris
        $materials  = $_POST['material_name'];   // Array nama material
        $units      = $_POST['unit'];            // Array satuan
        $quantities = $_POST['quantity'];        // Array qty
        $unitPrices = $_POST['unit_price'];      // Array harga satuan
        $totalCosts = $_POST['total_cost'];      // Array total harga

        // Loop setiap baris data
        for ($i = 0; $i < count($materials); $i++) {
            $cat     = mysqli_real_escape_string($conn, $categories[$i] ?? '');
            $matName = mysqli_real_escape_string($conn, $materials[$i] ?? '');
            $unitVal = mysqli_real_escape_string($conn, $units[$i] ?? '');
            $qty     = intval($quantities[$i] ?? 0);
            $unitP   = intval($unitPrices[$i] ?? 0);
            $totalC  = intval($totalCosts[$i] ?? 0);

            // Skip baris kosong
            if (empty($matName)) continue;

            $query_detail = "
                INSERT INTO rab_detail (id_rab, category, material_name, unit, quantity, unitPrice, totalCost)
                VALUES ('$id_rab', '$cat', '$matName', '$unitVal', '$qty', '$unitP', '$totalC')
            ";

            $result_detail = mysqli_query($conn, $query_detail);

            if (!$result_detail) {
                echo '⚠️ Gagal insert detail: ' . mysqli_error($conn) . '<br>';
            }
        }
    }

    echo "<script>alert('✅ RAB berhasil disimpan!'); window.location='rab.php';</script>";
    exit;

} else {
    echo "<script>alert('Akses tidak valid!'); window.location='rab.php';</script>";
}
?>
