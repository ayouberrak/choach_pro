<?php

require_once __DIR__ . '/../config/config.php';
$conn = conn();


function insertseances($debut,$duree,$id_client,$id_coach,$id_sport,$date_seances){
    global $conn;
    $sql = "INSERT INTO seances(debut,duree,id_client,id_coach,id_sport,date_seances)
            VALUES(:debut,:duree,:id_client,:id_coach,:id_sport,:date_seances)";
    $stmt= $conn->prepare($sql);
    return $stmt->execute([
        'debut'=>$debut,
        'duree'=>$duree,
        'id_client'=>$id_client,
        'id_coach'=>$id_coach,
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

function getseancesEnatt($id_coach , $ids){
    global $conn;
    $sql = "SELECT CONCAT(u.nom,' ',u.prenom) as fulnameClient ,
            CONCAT(s.date_seances,' ',s.debut) as dateandtime,
            sp.type , st.type_status  From user u 
            INNER JOIN seances s ON s.id_client = u.id
            INNER JOIN sport sp ON sp.id_sport = s.id_sport
            INNER JOIN status st ON st.id_status = s.id_status
            WHERE s.id_status = :idS and s.id_coach =:id ";
    $res = $conn ->prepare($sql);
    $res->execute([
        'id'=>$id_coach,
        'idS'=>$ids
    ]);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}