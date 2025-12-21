<?php
require_once __DIR__ ."/../config/config.php";
$conn = conn();

function insertDispo($id_coach,$jour,$heures_debut,$heures_fin){
    global $conn;
    $sql = "INSERT into disponible(id_coach,jour,heures_debut,heures_fin)
            VALUES(:id_coach,:jour,:heures_debut,:heures_fin)";
    $res=$conn->prepare($sql);
    return $res->execute([
        'id_coach'=>$id_coach,
        'jour'=>$jour,
        'heures_debut'=>$heures_debut,
        'heures_fin'=>$heures_fin
    ]);
}


function getAllDispo($id_coach){
    global $conn;
    $sql = "SELECT * FROM disponible WHERE id_coach = :id";
    $res = $conn->prepare($sql);
    $res->execute([
        'id'=>$id_coach
    ]);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}



function deleteDispo($id_dispo){
    global $conn;
    $sql = "DELETE FROM disponible WHERE id_dispo=:id";
    $res=$conn->prepare($sql);
    return $res->execute([
        'id'=>$id_dispo
    ]);
}


function getDispoById($id_dispo){
    global $conn;
    $sql = "SELECT * FROM disponible WHERE id_dispo = :id";
    $res = $conn->prepare($sql);
    $res->execute([
        'id'=>$id_dispo
    ]);
    return $res->fetch(PDO::FETCH_ASSOC);
}

