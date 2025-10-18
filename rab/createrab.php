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
  <style>
    .category-block { background: #f8f9fa; }
    .total-box { background: #fff3cd; font-weight: bold; border-radius: 8px; }
  </style>
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
          
          <!-- =================== TAB INFO =================== -->
          <div class="tab-pane fade show active" id="info">
            <div class="row mb-3">
              <div class="col-md-6">
                <label>Project Name</label>
                <input type="text" name="project_name" class="form-control mb-2" required>
                <label>Type (misal: 120 m²)</label>
                <input type="number" name="type" id="type" class="form-control mb-2" required>
                <label>Location</label>
                <input type="text" name="location" class="form-control mb-2" required>
              </div>
              <div class="col-md-6">
                <label>Number of Units</label>
                <input type="number" name="unit" id="unit" class="form-control mb-2" required>
                <label>Notes</label>
                <textarea name="notes" class="form-control" placeholder="Keterangan tambahan..."></textarea>
              </div>
            </div>
          </div>

          <!-- =================== TAB BUDGET =================== -->
          <div class="tab-pane fade" id="budget">
            <div id="budget-container"></div>
            <button type="button" id="addCategory" class="btn btn-success mt-3">
              <i class="bi bi-plus-circle"></i> Tambah Kategori
            </button>

            <hr class="my-4">
            <div class="row align-items-center">
              <div class="col-md-3">
                <label class="fw-bold">Total Keseluruhan</label>
                <input type="text" id="grandTotal" class="form-control total-box text-end" readonly>
              </div>
              <div class="col-md-3">
                <label class="fw-bold">Pembulatan</label>
                <input type="number" id="pembulatan" name="pembulatan" class="form-control text-end" value="0">
              </div>
              <div class="col-md-3">
                <label class="fw-bold">Per Meter Persegi</label>
                <input type="text" id="permeter" class="form-control text-end" readonly>
              </div>
            </div>
          </div>

          <!-- =================== TAB ADDITIONAL (UPDATE) =================== -->
          <div class="tab-pane fade" id="additional">
            <div id="additional-container"></div>
            <button type="button" id="addCategoryAdditional" class="btn btn-outline-primary mt-3">
              <i class="bi bi-plus-circle"></i> Tambah Kategori (Additional)
            </button>

            <hr class="my-4">

            <!-- === FIELD TOTAL SEPERTI TAB BUDGET === -->
            <div class="row align-items-center">
              <div class="col-md-3">
                <label class="fw-bold">Total Keseluruhan (Budget + Additional)</label>
                <input type="text" id="grandTotalAdditional" class="form-control total-box text-end" readonly>
              </div>
              <div class="col-md-3">
                <label class="fw-bold">Pembulatan</label>
                <input type="number" id="pembulatanAdditional" class="form-control text-end" value="0">
              </div>
              <div class="col-md-3">
                <label class="fw-bold">Per Meter Persegi</label>
                <input type="text" id="permeterAdditional" class="form-control text-end" readonly>
              </div>
            </div>

            <div class="mt-4 text-end">
              <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Simpan RAB</button>
            </div>
          </div>

        </div>
      </form>
    </div>
  </div>
</div>

<!-- =============== MODAL PILIH MATERIAL =============== -->
<div class="modal fade" id="materialModal" tabindex="-1" aria-labelledby="materialModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content shadow">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="materialModalLabel"><i class="bi bi-box-seam"></i> Pilih Material</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="text" id="searchMaterial" class="form-control mb-3" placeholder="🔍 Cari nama material, spesifikasi, atau supplier...">
        <div class="table-responsive">
          <table class="table table-hover align-middle" id="tableMaterial">
            <thead class="table-primary text-center">
              <tr>
                <th>Nama Material</th>
                <th>Spesifikasi</th>
                <th>Unit</th>
                <th>Harga (Rp)</th>
                <th>Supplier</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $qMaterial = mysqli_query($conn, "
                SELECT m.name, m.specification, m.unit, m.price, u.nama AS supplier_name
                FROM material m 
                JOIN users u ON m.id_user = u.id_user
                ORDER BY m.name ASC
              ");
              while($mat = mysqli_fetch_assoc($qMaterial)): ?>
              <tr>
                <td><?= htmlspecialchars($mat['name']) ?></td>
                <td><?= htmlspecialchars($mat['specification']) ?></td>
                <td class="text-center"><?= htmlspecialchars($mat['unit']) ?></td>
                <td class="text-end"><?= number_format($mat['price']) ?></td>
                <td><?= htmlspecialchars($mat['supplier_name']) ?></td>
                <td class="text-center">
                  <button type="button" class="btn btn-success btn-sm selectMaterial"
                    data-name="<?= htmlspecialchars($mat['name']) ?>"
                    data-unit="<?= htmlspecialchars($mat['unit']) ?>"
                    data-price="<?= htmlspecialchars($mat['price']) ?>">
                    Pilih
                  </button>
                </td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
let currentRow = null;

// ======== Modal Material ========
document.addEventListener('click', e => {
  if (e.target.closest('.openMaterialModal')) {
    currentRow = e.target.closest('.row');
  }
});
document.addEventListener('click', e => {
  if (e.target.classList.contains('selectMaterial')) {
    const name = e.target.dataset.name;
    const unit = e.target.dataset.unit;
    const price = e.target.dataset.price;
    if (currentRow) {
      currentRow.querySelector('.material-input').value = name;
      currentRow.querySelector('input[name="unit[]"]').value = unit;
      currentRow.querySelector('input[name="unit_price[]"]').value = price;
      currentRow.querySelector('input[name="quantity[]"]').value = 1;
      updateTotal(currentRow);
    }
    bootstrap.Modal.getInstance(document.getElementById('materialModal')).hide();
  }
});

// ======== Tambah Kategori ========
document.getElementById('addCategory').addEventListener('click', () => addCategory('budget-container'));
document.getElementById('addCategoryAdditional').addEventListener('click', () => addCategory('additional-container'));

function addCategory(containerId) {
  const container = document.getElementById(containerId);
  const block = document.createElement('div');
  block.className = 'category-block border p-3 mb-4 rounded';
  block.innerHTML = `
    <div class="d-flex justify-content-between align-items-center mb-2">
      <input type="text" name="category[]" class="form-control w-50" placeholder="Nama Kategori">
      <button type="button" class="btn btn-outline-danger btn-sm removeCategory">🗑 Hapus Kategori</button>
    </div>
    <div class="category-items"></div>
    <div class="mt-2"><button type="button" class="btn btn-outline-primary btn-sm addItem"><i class="bi bi-plus"></i> Tambah Material</button></div>
    <div class="text-end mt-3"><b>Total Kategori:</b> <span class="catTotal">0</span></div>
  `;
  container.appendChild(block);
}

// ======== Tambah Material ========
document.addEventListener('click', e => {
  if (e.target.classList.contains('addItem')) {
    const row = document.createElement('div');
    row.className = 'row mb-2 align-items-center';
    row.innerHTML = `
      <div class="col-md-3 d-flex align-items-center">
        <input name="material_name[]" class="form-control me-1 material-input" placeholder="Ketik atau pilih material...">
        <button type="button" class="btn btn-outline-primary btn-sm openMaterialModal" data-bs-toggle="modal" data-bs-target="#materialModal">
          <i class="bi bi-search"></i>
        </button>
      </div>
      <div class="col-md-1"><input name="unit[]" class="form-control" placeholder="Unit"></div>
      <div class="col-md-1"><input name="quantity[]" type="number" class="form-control qty" placeholder="Qty" value="1" min="1"></div>
      <div class="col-md-2"><input name="unit_price[]" type="number" class="form-control unitprice" placeholder="Harga"></div>
      <div class="col-md-2"><input name="total_cost[]" type="number" class="form-control total text-end" placeholder="Total" readonly></div>
      <div class="col-md-1 text-center"><button type="button" class="btn btn-outline-danger btn-sm removeItem">🗑</button></div>
    `;
    e.target.closest('.category-block').querySelector('.category-items').appendChild(row);
  }
});

// ======== Hapus Item / Kategori ========
document.addEventListener('click', e => {
  if (e.target.classList.contains('removeCategory')) e.target.closest('.category-block').remove();
  if (e.target.classList.contains('removeItem')) e.target.closest('.row').remove();
  calculateAll();
});

// ======== Kalkulasi ========
document.addEventListener('input', e => {
  if (e.target.classList.contains('qty') || e.target.classList.contains('unitprice')) updateTotal(e.target.closest('.row'));
  if (e.target.id === 'unit') updateAdditionalTotals();
  if (e.target.id === 'pembulatan' || e.target.id === 'unit') calculatePerMeter();
  if (e.target.id === 'pembulatanAdditional') calculatePerMeterAdditional();
});

function updateTotal(row) {
  const qty = parseFloat(row.querySelector('.qty')?.value || 0);
  const price = parseFloat(row.querySelector('.unitprice')?.value || 0);
  const container = row.closest('.tab-pane');
  const totalInput = row.querySelector('.total');
  if (container && container.id === 'additional') {
    const unitCount = parseFloat(document.getElementById('unit').value || 1);
    const total = unitCount > 0 ? (qty * price) / unitCount : qty * price;
    totalInput.value = total;
  } else totalInput.value = qty * price;
  calculateAll();
}

function calculateAll() {
  // === Hitung total Budget ===
  let grand = 0;
  document.querySelectorAll('#budget-container .category-block').forEach(cat => {
    let subtotal = 0;
    cat.querySelectorAll('.total').forEach(t => subtotal += parseFloat(t.value || 0));
    cat.querySelector('.catTotal').textContent = subtotal.toLocaleString('id-ID');
    grand += subtotal;
  });
  document.getElementById('grandTotal').value = grand.toLocaleString('id-ID');

  // === Hitung total Additional ===
  updateAdditionalTotals(grand);
  calculatePerMeter();
}

function updateAdditionalTotals(grandBudget = 0) {
  let grandAdd = 0;
  document.querySelectorAll('#additional-container .category-block').forEach(cat => {
    let subtotal = 0;
    cat.querySelectorAll('.total').forEach(input => subtotal += parseFloat(input.value || 0));
    cat.querySelector('.catTotal').textContent = subtotal.toLocaleString('id-ID');
    grandAdd += subtotal;
  });

  const totalAll = grandBudget + grandAdd;
  document.getElementById('grandTotalAdditional').value = totalAll.toLocaleString('id-ID');
  calculatePerMeterAdditional();
}

function calculatePerMeter() {
  const pembulatan = parseFloat(document.getElementById('pembulatan').value || 0);
  const type = parseFloat(document.getElementById('type').value || 0);
  const perMeter = type > 0 ? pembulatan / type : 0;
  document.getElementById('permeter').value = perMeter.toLocaleString('id-ID', { maximumFractionDigits: 2 });
}

function calculatePerMeterAdditional() {
  const pembulatanAdd = parseFloat(document.getElementById('pembulatanAdditional').value || 0);
  const type = parseFloat(document.getElementById('type').value || 0);
  const perMeterAdd = type > 0 ? pembulatanAdd / type : 0;
  document.getElementById('permeterAdditional').value = perMeterAdd.toLocaleString('id-ID', { maximumFractionDigits: 2 });
}

// ======== Search Material ========
document.getElementById('searchMaterial').addEventListener('keyup', function() {
  const val = this.value.toLowerCase();
  document.querySelectorAll('#tableMaterial tbody tr').forEach(row => {
    row.style.display = row.innerText.toLowerCase().includes(val) ? '' : 'none';
  });
});
</script>
</body>
</html>
