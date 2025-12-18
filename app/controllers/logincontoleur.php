<?php

    session_start();
    
require_once __DIR__ . '/../models/loginmodel.php';
require_once __DIR__ . '/../config/config.php';

$conn = conn();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        header("Location: logincontoleur.php?error=empty");
        exit();
    }

    $user = ceckLogin($conn, $email, $password);

    if (!$user) {
        header("Location: logincontoleur.php?error=invalid");
        exit();
    }


    
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['nom'];
    $_SESSION['user_role'] = $user['id_role'];



    if ($user['id_role'] == 2) {
        header("Location: aceuliControleur.php");
        exit();
    } elseif ($user['id_role'] == 1) {
        header("Location: aceuliControleur.php");
        exit();
    } else {
        header("Location: logincontoleur.php?error=role");
        exit();
    }

}








require_once __DIR__ .'/../views/loginview.php';