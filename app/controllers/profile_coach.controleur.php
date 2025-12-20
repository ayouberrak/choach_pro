<?php 
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../config/config.php';
$conn=conn();
require_once __DIR__ . '/../models/coach.model.php';
$id_coach = $_SESSION['user_id'];

$coach = getcoachby($conn, $id_coach);



if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $annees_experiance = $_POST['experience'];
    $certification = $_POST['certificats'];
    $bio = $_POST['bio'];



        $res= updatecoach($conn, $id_coach, $nom, $prenom, $email, $password, $annees_experiance, $certification, $bio);
        if($res){
            header('Location: profile_coach.controleur.php?update=yes');
            exit;
        }else{
            header('Location: profile_coach.controleur.php?update=no');
            exit;
        }
    }

require_once __DIR__ . '/../views/profile_coach.view.php';