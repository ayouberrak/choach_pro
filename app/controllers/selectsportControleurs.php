<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../models/sport.models.php";

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 2) {
    header("Location: logincontoleur.php?error=unauthorized");
    exit();
}
$id=$_SESSION['user_id'];

if (!isset($_SESSION['sports'])) {
    $_SESSION['sports'] = [];
}

$selectedSports = $_SESSION['sports'];

if($_SERVER['REQUEST_METHOD']==='POST'){
    $allOk = true;
    foreach($selectedSports as $sport){
        $resp = insertSport($sport, $id);
        if(!$resp){
            $allOk = false;
        }
    }

    if(isset($_POST['sport_new']) && !empty($_POST['sport_new'])){
        $allOk = true;
        $type = trim($_POST['sport_new']);
        $id_sport_next = insertSportnew($type);
        $resp=insertSport($id_sport_next, $id);
        if(!$resp){
            $allOk = false;
        }
    }
    if($allOk){
        header('Location: coach.conttoleur.php?sportAdd=yes');
    } else {
        header('Location: selectsportControleurs.php?sportAdd=no');
    }
    exit;
}



$sport = getsport();
// print_r($sport);

    require_once __DIR__ .'/../views/selectsport.php';
?>
