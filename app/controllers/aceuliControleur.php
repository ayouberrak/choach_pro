<?php  
session_start();
require_once __DIR__ . '/../models/seacnes.model.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 1) {
    header("Location: ../controllers/logincontoleur.php");
    exit();
} 

updateAllSeancesTerminer();


require_once __DIR__ ."/../views/acueill.view.php";