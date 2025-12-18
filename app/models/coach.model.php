<?php


require_once __DIR__ ."/../config/config.php";


function getcoachby($conn, $id){
    $sql = "SELECT u.nom,u.prenom , co.*  FROM user u inner JOIN coach co ON u.id = co.id_coach WHERE co.id_coach = :id_coach";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id_coach' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}