<?php
session_start();

if (!isset($_SESSION['user_id']) && $_SESSION['user_role'] != 2) {
    header("Location: logincontoleur.php?error=unauthorized");
    exit();
}



require_once __DIR__ .'/../views/selectsport.php';
?>
