<?php
session_start();

if (!isset($_SESSION['sports'])) {
    $_SESSION['sports'] = [];
}

if (isset($_POST['id_sport_active'])) {
    $idSport = (int) $_POST['id_sport_active'];

    if (!in_array($idSport, $_SESSION['sports'])) {
        $_SESSION['sports'][] = $idSport;
    }
}

// رجّع JSON فقط
header('Content-Type: application/json');
echo json_encode($_SESSION['sports']);
exit(); // ضروري باش ما يكملش باقي الكود
