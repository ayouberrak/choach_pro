<?php 
session_start();    
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . '/../models/seacnes.model.php';

$id_coach=$_SESSION['user_id'];


$seances=getTousSeancesPourCoach($id_coach);


// print_r($seances);

require_once __DIR__ . '/../views/seances_coach.view.php';