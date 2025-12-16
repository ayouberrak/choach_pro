<?php
session_start();

// Detect login by checking the login submit button
if (isset($_POST['login_submit'])) {
    require_once __DIR__ . '/../models/loginModels.php';
    require_once __DIR__ . '/../config/config.php';

    $email = $_POST['email'] ?? '';
    $password = $_POST['pass'] ?? '';

    // Debug log incoming POST
    error_log('LOGIN POST: ' . print_r($_POST, true));

    $conn = conn();
    $user = checkLogin($conn, $email, $password);

    // Debug log lookup result
    error_log('LOGIN user: ' . print_r($user, true));
    error_log('LOGIN headers_sent: ' . (headers_sent() ? 'yes' : 'no'));

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'coach') {
            header('Location: ../views/coachDash.php');
        } elseif ($user['role'] === 'client') {
            header('Location: ../views/clientDash.php');
        }
        exit;
    } else {
        $error_message = 'Invalid email or password.';
    }
} else {
    $error_message = '';
}

require_once __DIR__ . '/../views/loginview.php';
