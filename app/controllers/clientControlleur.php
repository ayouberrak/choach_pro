<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();
require_once __DIR__ ."/../models/cilentmodel.php";

if (!isset($_SESSION['user_id']) && $_SESSION['user_role'] != 1) {
    header("Location: ../controllers/logincontoleur.php");
    exit();
}

$user_name = $_SESSION['user_name'];

$chaoch = getcoach();




require_once __DIR__ .'/../views/clientDash.view.php';
?>