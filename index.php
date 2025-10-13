<?php
session_start();
if (isset($_SESSION['role'])) {
    header("Location: ./views/dashboard.php");
} else {
    header("Location: ./login.php");
}
exit;
?>
