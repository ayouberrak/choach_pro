<?php
session_start();


require_once __DIR__ . '/../config/config.php';
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 2) {
    header("Location: logincontoleur.php");
    exit();
}



require_once __DIR__ . '/../views/coachDash.view.php';


?>