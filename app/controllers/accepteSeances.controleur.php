<?php
session_start();
require_once __DIR__ .'/../models/seacnes.model.php';

$id_seances=$_GET['id'];
$res =updateStatusSeances($id_seances,6);

if($res){
    header('Location: ../controllers/coach.conttoleur.php?change=yes');
    exit;
}else{
    header('Location: ../controllers/coach.conttoleur.php?change=no');
    exit;
}


