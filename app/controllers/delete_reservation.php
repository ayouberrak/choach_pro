<?php 
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../models/seacnes.model.php';

$id_seance = $_GET['id'];

    $res = updateSeancesEnattente($id_seance);
    if($res){
        header('Location: mes_seanes.controler.php?delete=yes');
        exit;
    }else{
        header('Location: mes_seanes.controler.php?delete=no');
        exit;
    }
