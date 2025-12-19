<?php 
session_start();

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    
require_once __DIR__ . '/../models/dispo.models.php';


$id_dispo = $_GET['id'];

$responese =deleteDispo($id_dispo);

if($responese){
    header('Location: dispo.contorleurs.php?delete=yes');
    exit;
}else{
    header('Location: dispo.contorleurs.php?delete=yes');
    exit;
}