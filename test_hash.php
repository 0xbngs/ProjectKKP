<?php
$input = 'admin123';
$hash = '$2y$10$u/.m5GkG/.e4kOZKZTr/4OcjsMmhJMjazPeG2pgUmkW9C3XbN6pHe';

if (password_verify($input, $hash)) {
    echo "✅ Cocok bro!";
} else {
    echo "❌ Tidak cocok!";
}
