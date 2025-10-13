<?php
session_start();
include '../config/database.php';

$id_user = $_SESSION['id_user'];
$id_rab = uniqid('RAB-');
$project_name = $_POST['project_name'];
$type = $_POST['type'];
$location = $_POST['location'];
$unit = $_POST['unit'];
$notes = $_POST['notes'] ?? '';
$additional = $_POST['additional_info'] ?? '';

mysqli_query($conn, "INSERT INTO rab (id_rab, id_user, project_name, type, location, unit, notes, additional_info) 
VALUES ('$id_rab','$id_user','$project_name','$type','$location','$unit','$notes','$additional')");

// Simpan detail budget
if (!empty($_POST['material_name'])) {
    foreach ($_POST['material_name'] as $i => $mat) {
        $u = $_POST['unit'][$i];
        $q = $_POST['quantity'][$i];
        $p = $_POST['unit_price'][$i];
        $t = $_POST['total_cost'][$i];
        mysqli_query($conn, "INSERT INTO rab_detail (id_rab, material_name, unit, quantity, unitPrice, totalCost)
        VALUES ('$id_rab','$mat','$u','$q','$p','$t')");
    }
}

echo "<script>alert('RAB berhasil dibuat!'); window.location='rab.php';</script>";
