<?php

require_once __DIR__ . '/../config/config.php';
$conn = conn();


function insertseances($debut,$duree,$id_client,$id_coach,$id_sport,$id_status,$date_seances){
    global $conn;
    $sql = "INSERT INTO seances(debut,duree,id_client,id_coach,id_status,id_sport,date_seances)
            VALUES(:debut,:duree,:id_client,:id_coach,:id_status,:id_sport,:date_seances)";
    $stmt= $conn->prepare($sql);
    return $stmt->execute([
        'debut'=>$debut,
        'duree'=>$duree,
        'id_client'=>$id_client,
        'id_coach'=>$id_coach,
        'id_status'=>$id_status,
        'id_sport'=>$id_sport,
        'date_seances'=>$date_seances
    ]);
}

function getseances($id_client){
    global $conn;
    $sql ="SELECT CONCAT(u.nom,' ',u.prenom) AS fullname , s.* FROM seances s INNER JOIN user u ON u.id = s.id_coach WHERE s.id_client=:id";
    $stmt= $conn->prepare($sql);
    $stmt->execute([
        'id'=>$id_client
    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}   