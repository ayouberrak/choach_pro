<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ ."/../config/config.php";
require_once __DIR__ ."/../models/coach.model.php";
require_once __DIR__ .'/../models/seacnes.model.php';
require_once __DIR__ .'/../models/sport.models.php';
require_once __DIR__ .'/../models/dispo.models.php';


$conn = conn();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 1) {
    header("Location: ../controllers/logincontoleur.php");
    exit();
}

$id_client = $_SESSION['user_id'];

$id_coach =$_GET['id'];
$coach_d = getcoachby($conn, $id_coach);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $date_debut = $_POST['date_debut'] ?? null;
    $heure_debut = $_POST['heure_debut'] ?? null;
    $duree = $_POST['duree'] ?? null;
    $type_sport = $_POST['type_sport'] ?? null;

    if (!$date_debut || !$heure_debut || !$duree || !$type_sport) {
        die("Tous les champs sont requis.");
    }

    $val = insertseances(
        $heure_debut,
        $duree,
        $id_client,
        $id_coach,
        $type_sport,
        $date_debut
    );

    if ($val === true) {
        header("Location: reservationControlleurs.php?id=$id_coach&reserver=yes");
        exit;
    } else {
        header('Location: reservationControlleurs.php?reserver=no');
    }
}

$sport = getSportBycoach($id_coach);

$diaponibilites = getAllDispo($id_coach);

require_once __DIR__ ."/../views/reservation.view.php";
