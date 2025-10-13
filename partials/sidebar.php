<?php $role = $_SESSION['role']; ?>
<div class="d-flex flex-column p-3 bg-light" style="width:250px;height:100vh;">
  <h5><?= ucfirst($role) ?> Menu</h5>
  <ul class="nav flex-column">
    <?php if($role === 'admin'): ?>
      <li><a href="user.php" class="nav-link">User</a></li>
      <li><a href="supplier.php" class="nav-link">Supplier</a></li>
    <?php endif; ?>

    <?php if($role !== 'supplier'): ?>
      <li><a href="rab.php" class="nav-link">RAB</a></li>
    <?php endif; ?>

    <li><a href="material.php" class="nav-link">Material</a></li>
  </ul>
</div>
