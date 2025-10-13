<?php
session_start();
include '../config/database.php';
include '../partials/header.php';
include '../partials/sidebar.php';

if (!isset($_SESSION['id_user'])) {
  header("Location: ../login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Buat RAB Baru</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body style="background-color:#f3f6fa;">
<div class="container mt-4">
  <div class="card shadow border-0">
    <div class="card-header bg-warning d-flex justify-content-between align-items-center">
      <h5 class="mb-0 text-dark"><i class="bi bi-pencil-square"></i> Create RAB</h5>
      <a href="rab.php" class="btn btn-dark btn-sm"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>

    <div class="card-body">
      <ul class="nav nav-tabs mb-3" id="rabTabs" role="tablist">
        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#info">Info</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#budget">Budget</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#additional">Additional</button></li>
      </ul>

      <form method="POST" action="saverab.php">
        <div class="tab-content">
          <!-- Tab Info -->
          <div class="tab-pane fade show active" id="info">
            <div class="row mb-3">
              <div class="col-md-6">
                <label>Project Name</label>
                <input type="text" name="project_name" class="form-control mb-2" required>
                <label>Type</label>
                <input type="text" name="type" class="form-control mb-2" required>
                <label>Location</label>
                <input type="text" name="location" class="form-control mb-2" required>
              </div>
              <div class="col-md-6">
                <label>Number of Units</label>
                <input type="number" name="unit" class="form-control mb-2" required>
                <label>Category</label>
                <input type="text" name="category" class="form-control mb-2">
                <label>Notes</label>
                <textarea name="notes" class="form-control"></textarea>
              </div>
            </div>
          </div>

          <!-- Tab Budget -->
          <div class="tab-pane fade" id="budget">
            <div id="budget-fields">
              <div class="row mb-2">
                <div class="col-md-3"><input name="material_name[]" class="form-control" placeholder="Material"></div>
                <div class="col-md-2"><input name="unit[]" class="form-control" placeholder="Unit"></div>
                <div class="col-md-2"><input name="quantity[]" type="number" class="form-control" placeholder="Qty"></div>
                <div class="col-md-2"><input name="unit_price[]" type="number" class="form-control" placeholder="Harga Satuan"></div>
                <div class="col-md-2"><input name="total_cost[]" type="number" class="form-control" placeholder="Total"></div>
                <div class="col-md-1 text-center"><button type="button" class="btn btn-outline-danger btn-sm" onclick="this.closest('.row').remove()">🗑</button></div>
              </div>
            </div>
            <button type="button" id="addRow" class="btn btn-outline-success btn-sm mt-2"><i class="bi bi-plus"></i> Tambah Baris</button>
          </div>

          <!-- Tab Additional -->
          <div class="tab-pane fade" id="additional">
            <textarea name="additional_info" class="form-control" rows="4" placeholder="Tambahan keterangan atau biaya lain..."></textarea>
          </div>
        </div>

        <div class="mt-4 text-end">
          <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Simpan RAB</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.getElementById('addRow').addEventListener('click', () => {
  const div = document.createElement('div');
  div.className = 'row mb-2';
  div.innerHTML = `
    <div class="col-md-3"><input name="material_name[]" class="form-control" placeholder="Material"></div>
    <div class="col-md-2"><input name="unit[]" class="form-control" placeholder="Unit"></div>
    <div class="col-md-2"><input name="quantity[]" type="number" class="form-control" placeholder="Qty"></div>
    <div class="col-md-2"><input name="unit_price[]" type="number" class="form-control" placeholder="Harga Satuan"></div>
    <div class="col-md-2"><input name="total_cost[]" type="number" class="form-control" placeholder="Total"></div>
    <div class="col-md-1 text-center"><button type="button" class="btn btn-outline-danger btn-sm" onclick="this.closest('.row').remove()">🗑</button></div>
  `;
  document.getElementById('budget-fields').appendChild(div);
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
