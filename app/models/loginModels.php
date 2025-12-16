<?php
require_once __DIR__ . '/../config/config.php';

function checkLogin($conn, $email, $password) {

        $sql = "SELECT u.id, u.password, r.type_role AS role
            FROM user u
            LEFT JOIN role r ON u.id_role = r.id_role
            WHERE u.email = :email";

    $stmt = $conn->prepare($sql);
    $stmt->execute(['email' => $email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        return $user; // login success
    }

    return false;
}
