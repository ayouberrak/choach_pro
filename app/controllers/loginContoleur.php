<?php


if($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../models/loginModels.php';

    $email = $_POST['email'] ?? '';
    $password = $_POST['pass'] ?? '';

    $conn = conn();
    $user = checkLogin($conn, $email, $password);

    if ($user) {
        
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        if ($user['role'] === 'coach') {
            header('Location: ../views/coachDash.php');
        } else {
            header('Location: ../views/clientDash.php');
        }
        exit;
    } else {
        
        $error_message = 'Invalid email or password.';
    }
}
















require_once __DIR__ . '/../views/loginview.php';