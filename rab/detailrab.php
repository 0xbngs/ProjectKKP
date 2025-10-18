<?php
session_start();
include '../config/database.php';
include '../partials/header.php';
include '../partials/sidebar.php';

// ======== CEK LOGIN ========
if (!isset($_SESSION['id_user'])) {
  header("Location: ../login.php");
  exit;
}

// ======== CEK PARAMETER ID ========
if (!isset($_GET['id'])) {
  echo "<script>alert('ID RAB tidak ditemukan'); window.location='rab.php';</script>";
  exit;
}

$id_rab = mysqli_real_escape_string($conn, $_GET['id']);

// ======== AMBIL DATA RAB UTAMA ========
$query_rab = mysqli_query($conn, "SELECT * FROM rab WHERE id_rab='$id_rab'");
if (!$query_rab || mysqli_num_rows($query_rab) == 0) {
  echo "<script>alert('Data RAB tidak ditemukan'); window.location='rab.php';</script>";
  exit;
}
$rab = mysqli_fetch_assoc($query_rab);

// ======== AMBIL DATA DETAIL ========
$query_detail = mysqli_query($conn, "SELECT * FROM rab_detail WHERE id_rab='$id_rab' ORDER BY category ASC");
$categories = [];
while ($row = mysqli_fetch_assoc($query_detail)) {
  $categories[$row['category']][] = $row;
}

// ======== AMBIL VERSI ========
$parent_id = $rab['parent_id'] ?? $id_rab;
$query_versions = mysqli_query($conn, "
  SELECT * FROM rab 
  WHERE (id_rab='$id_rab' OR parent_id='$id_rab' OR parent_id='$parent_id')
  ORDER BY created_at DESC
");

$totalKeseluruhan = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail & Edit RAB</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    .category-block { background: #f8f9fa; border-radius: 8px; padding: 15px; margin-bottom: 15px; }
    .total-box { background: #fff3cd; font-weight: bold; border-radius: 8px; }
  </style>
</head>

<body style="background-color:#f3f6fa;">
<div class="container mt-4">

  <!-- ========== INFO UTAMA ========== -->
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

  <!-- ========== TABEL DETAIL ========== -->
  <div class="card shadow border-0 mb-4">
    <div class="card-header bg-light d-flex justify-content-between align-items-center">
      <h6 class="mb-0"><i class="bi bi-list-ul"></i> Rincian Anggaran Biaya</h6>
      <button class="btn btn-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#editRAB">
        <i class="bi bi-pencil-square"></i> Edit RAB
      </button>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
          <thead class="table-warning text-center">
            <tr>
              <th>No</th><th>Kategori</th><th>Nama Material</th><th>Unit</th>
              <th>Quantity</th><th>Harga Satuan</th><th>Total</th>
            </tr>
          </thead>
          <tbody>
            <?php if (count($categories) > 0): ?>
              <?php $no=1; foreach ($categories as $cat => $materials): ?>
                <?php foreach ($materials as $d): ?>
                  <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= htmlspecialchars($cat) ?></td>
                    <td><?= htmlspecialchars($d['material_name']) ?></td>
                    <td class="text-center"><?= htmlspecialchars($d['unit']) ?></td>
                    <td class="text-center"><?= number_format($d['quantity']) ?></td>
                    <td class="text-end"><?= number_format($d['unitPrice']) ?></td>
                    <td class="text-end"><?= number_format($d['totalCost']) ?></td>
                  </tr>
                  <?php $totalKeseluruhan += $d['totalCost']; ?>
                <?php endforeach; ?>
              <?php endforeach; ?>
              <tr class="table-warning fw-bold">
                <td colspan="6" class="text-end">Total Keseluruhan:</td>
                <td class="text-end">Rp <?= number_format($totalKeseluruhan) ?></td>
              </tr>
            <?php else: ?>
              <tr><td colspan="7" class="text-center text-muted">Belum ada data detail</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- ========== FORM EDIT RAB (TABS: INFO, BUDGET, ADDITIONAL) ========== -->
  <div id="editRAB" class="collapse mb-5">
    <div class="card shadow border-0">
      <div class="card-header bg-primary text-white">
        <h6 class="mb-0"><i class="bi bi-pencil"></i> Edit dan Simpan Versi Baru</h6>
      </div>
      <div class="card-body">
        <form method="POST" action="save_edit_rab.php">
          <input type="hidden" name="parent_id" value="<?= htmlspecialchars($id_rab) ?>">
          <input type="hidden" name="old_id_rab" value="<?= htmlspecialchars($id_rab) ?>">

          <ul class="nav nav-tabs mb-3" id="editTabs" role="tablist">
            <li class="nav-item"><button type="button" class="nav-link active" data-bs-toggle="tab" data-bs-target="#tabInfo">Info</button></li>
            <li class="nav-item"><button type="button" class="nav-link" data-bs-toggle="tab" data-bs-target="#tabBudget">Budget</button></li>
            <li class="nav-item"><button type="button" class="nav-link" data-bs-toggle="tab" data-bs-target="#tabAdditional">Additional</button></li>
          </ul>

          <div class="tab-content">
            <!-- TAB INFO -->
            <div class="tab-pane fade show active" id="tabInfo">
              <div class="row mb-3">
                <div class="col-md-6">
                  <label>Project Name</label>
                  <input type="text" name="project_name" class="form-control mb-2" value="<?= htmlspecialchars($rab['project_name']) ?>" required>
                  <label>Type (m²)</label>
                  <input type="number" name="type" class="form-control mb-2" value="<?= htmlspecialchars($rab['type']) ?>" required>
                  <label>Location</label>
                  <input type="text" name="location" class="form-control mb-2" value="<?= htmlspecialchars($rab['location']) ?>" required>
                </div>
                <div class="col-md-6">
                  <label>Unit</label>
                  <input type="number" name="unit" class="form-control mb-2" value="<?= htmlspecialchars($rab['unit']) ?>" required>
                  <label>Notes</label>
                  <textarea name="notes" class="form-control"><?= htmlspecialchars($rab['notes']) ?></textarea>
                </div>
              </div>
            </div>

            <!-- TAB BUDGET -->
            <div class="tab-pane fade" id="tabBudget">
              <div id="budget-container">
                <?php
                $i = 0;
                foreach ($categories as $cat => $materials):
                ?>
                  <div class="category-block mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                      <input type="text" name="category[budget][<?= $i ?>][name]" class="form-control w-50" value="<?= htmlspecialchars($cat) ?>">
                      <button type="button" class="btn btn-outline-danger btn-sm removeCategory">🗑 Hapus</button>
                    </div>
                    <div class="category-items">
                      <?php $j = 0; foreach ($materials as $mat): ?>
                        <div class="row mb-2 align-items-center">
                          <div class="col-md-3"><input name="category[budget][<?= $i ?>][materials][<?= $j ?>][material_name]" value="<?= htmlspecialchars($mat['material_name']) ?>" class="form-control"></div>
                          <div class="col-md-2"><input name="category[budget][<?= $i ?>][materials][<?= $j ?>][unit]" value="<?= htmlspecialchars($mat['unit']) ?>" class="form-control"></div>
                          <div class="col-md-2"><input name="category[budget][<?= $i ?>][materials][<?= $j ?>][quantity]" type="number" value="<?= htmlspecialchars($mat['quantity']) ?>" class="form-control qty-input"></div>
                          <div class="col-md-2"><input name="category[budget][<?= $i ?>][materials][<?= $j ?>][unit_price]" type="number" value="<?= htmlspecialchars($mat['unitPrice']) ?>" class="form-control price-input"></div>
                          <div class="col-md-2"><input name="category[budget][<?= $i ?>][materials][<?= $j ?>][total_cost]" value="<?= htmlspecialchars($mat['totalCost']) ?>" class="form-control text-end total" readonly></div>
                          <div class="col-md-1 text-center"><button type="button" class="btn btn-outline-danger btn-sm removeItem">🗑</button></div>
                        </div>
                      <?php $j++; endforeach; ?>
                    </div>
                    <button type="button" class="btn btn-outline-primary btn-sm addItem mt-2" data-cat="<?= $i ?>" data-type="budget"><i class="bi bi-plus"></i> Tambah Material</button>
                    <div class="text-end mt-2"><b>Total Kategori:</b> <span class="catTotal">0</span></div>
                  </div>
                <?php $i++; endforeach; ?>
              </div>
              <button type="button" id="addCategoryBudget" class="btn btn-success"><i class="bi bi-plus-circle"></i> Tambah Kategori</button>
            </div>

            <!-- TAB ADDITIONAL -->
            <div class="tab-pane fade" id="tabAdditional">
              <div id="additional-container">
                <p class="text-muted">Tambahkan kategori tambahan di sini...</p>
              </div>
              <button type="button" id="addCategoryAdditional" class="btn btn-outline-primary mt-2"><i class="bi bi-plus-circle"></i> Tambah Kategori Additional</button>
            </div>
          </div>

          <hr>
          <div class="text-end mt-3">
            <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Simpan Versi Baru</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- ========== HISTORY VERSI ========== -->
  <div class="card shadow border-0">
    <div class="card-header bg-secondary text-white">
      <h6 class="mb-0"><i class="bi bi-clock-history"></i> Riwayat Versi Sebelumnya</h6>
    </div>
    <div class="card-body">
      <ul class="list-group">
        <?php if (mysqli_num_rows($query_versions) > 1): ?>
          <?php while ($ver = mysqli_fetch_assoc($query_versions)): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <span><b><?= htmlspecialchars($ver['project_name']) ?></b> — <?= htmlspecialchars($ver['created_at']) ?></span>
              <a href="detailrab.php?id=<?= htmlspecialchars($ver['id_rab']) ?>" class="btn btn-outline-primary btn-sm">Lihat</a>
            </li>
          <?php endwhile; ?>
        <?php else: ?>
          <li class="list-group-item text-muted text-center">Belum ada versi sebelumnya</li>
        <?php endif; ?>
      </ul>
    </div>
  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
let categoryIndex = document.querySelectorAll('.category-block').length;

document.getElementById('addCategoryBudget').addEventListener('click', () => addCategory('budget-container', 'budget'));
document.getElementById('addCategoryAdditional').addEventListener('click', () => addCategory('additional-container', 'additional'));

function addCategory(containerId, tabType) {
  const container = document.getElementById(containerId);
  const idx = categoryIndex++;

  const block = document.createElement('div');
  block.className = 'category-block mb-4';
  block.innerHTML = `
    <div class="d-flex justify-content-between align-items-center mb-2">
      <input type="text" name="category[${tabType}][${idx}][name]" class="form-control w-50" placeholder="Nama Kategori">
      <button type="button" class="btn btn-outline-danger btn-sm removeCategory">🗑 Hapus</button>
    </div>
    <div class="category-items" data-cat="${idx}" data-type="${tabType}"></div>
    <button type="button" class="btn btn-outline-primary btn-sm addItem mt-2" data-cat="${idx}" data-type="${tabType}">
      <i class="bi bi-plus"></i> Tambah Material
    </button>
    <div class="text-end mt-2"><b>Total Kategori:</b> <span class="catTotal">0</span></div>
  `;
  container.appendChild(block);
}

document.addEventListener('click', e => {
  if (e.target.classList.contains('addItem')) {
    const cat = e.target.dataset.cat;
    const type = e.target.dataset.type;
    const container = e.target.closest('.category-block').querySelector('.category-items');
    const materialIndex = container.querySelectorAll('.row').length;

    const row = document.createElement('div');
    row.className = 'row mb-2 align-items-center';
    row.innerHTML = `
      <div class="col-md-3"><input name="category[${type}][${cat}][materials][${materialIndex}][material_name]" class="form-control material-input" placeholder="Nama Material"></div>
      <div class="col-md-2"><input name="category[${type}][${cat}][materials][${materialIndex}][unit]" class="form-control unit-input" placeholder="Unit"></div>
      <div class="col-md-2"><input name="category[${type}][${cat}][materials][${materialIndex}][quantity]" type="number" class="form-control qty-input" value="1" min="1"></div>
      <div class="col-md-2"><input name="category[${type}][${cat}][materials][${materialIndex}][unit_price]" type="number" class="form-control price-input" value="0"></div>
      <div class="col-md-2"><input name="category[${type}][${cat}][materials][${materialIndex}][total_cost]" type="number" class="form-control total text-end" value="0" readonly></div>
      <div class="col-md-1 text-center"><button type="button" class="btn btn-outline-danger btn-sm removeItem">🗑</button></div>
    `;
    container.appendChild(row);
  }

  if (e.target.classList.contains('removeCategory')) e.target.closest('.category-block').remove();
  if (e.target.classList.contains('removeItem')) e.target.closest('.row').remove();
});

document.addEventListener('input', e => {
  if (e.target.classList.contains('qty-input') || e.target.classList.contains('price-input')) {
    updateTotal(e.target.closest('.row'));
  }
});

function updateTotal(row) {
  const qty = parseFloat(row.querySelector('.qty-input').value || 0);
  const price = parseFloat(row.querySelector('.price-input').value || 0);
  const total = qty * price;
  row.querySelector('.total').value = total;
}
</script>
</body>
</html>
