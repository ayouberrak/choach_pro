<?php
require_once __DIR__ . '/../config/config.php';

function checkLogin($conn, $email, $password){
    // Fetch user by email and include role type
    $res = $conn->prepare(
        "SELECT u.*, r.type_role AS role
         FROM user u
         LEFT JOIN role r ON u.id_role = r.id_role
         WHERE u.email = :email"
    );
    $res->execute(['email' => $email]);
    $user = $res->fetch(PDO::FETCH_ASSOC);

    if ($user && !empty($user['password'])) {
        // Verify password using password_verify
        if (password_verify($password, $user['password'])) {
            return $user;
        }
    }

    return false;
}