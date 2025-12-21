<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 2) {
    header("Location: ../controllers/logincontoleur.php");
    exit();
} 





require_once __DIR__ . '/../models/seacnes.model.php';

$nom = $_SESSION['user_name'];

$id_coach=$_SESSION['user_id'];

$resutlt = getseancesEnatt($id_coach,5);

$resutltAcc = getseancesEnatt($id_coach,6);





require_once __DIR__ . '/../views/coach.view.php';