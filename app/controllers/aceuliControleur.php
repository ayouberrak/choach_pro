<?php  
session_start();
if (!isset($_SESSION['user_id']) && $_SESSION['user_role'] != 1) {
    header("Location: ../controllers/logincontoleur.php");
    exit();
} 


require_once __DIR__ ."/../views/acueill.view.php";