<?php
$plain = 'admin123';
echo "Password: $plain<br>";
echo "Hash baru: " . password_hash($plain, PASSWORD_DEFAULT);
?>
