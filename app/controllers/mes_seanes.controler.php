<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$id_client =$_SESSION['user_id'];

require_once __DIR__ . "/../models/seacnes.model.php";

$reservation = getseances($id_client);

// print_r($reservation);

require_once __DIR__ ."/../views/mes_seances.view.php";