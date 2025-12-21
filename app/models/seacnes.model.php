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
function insertseancesavecstatusaccepte($debut,$duree,$id_client,$id_coach,$id_sport,$date_seances){
    global $conn;
    $sql = "INSERT INTO seances(debut,duree,id_client,id_coach,id_sport,date_seances,id_status)
            VALUES(:debut,:duree,:id_client,:id_coach,:id_sport,:date_seances,6)";
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
    $sql ="SELECT CONCAT(u.nom,' ',u.prenom) AS fullname , s.* , st.type_status, st.style, sp.type FROM seances s 
    INNER JOIN user u ON u.id = s.id_coach INNER JOIN status st ON st.id_status = s.id_status 
    INNER JOIN sport sp ON sp.id_sport = s.id_sport WHERE s.id_client=:id";
    $stmt= $conn->prepare($sql);
    $stmt->execute([
        'id'=>$id_client
    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}   
function getTousSeancesPourCoach($id_coach){
    global $conn;
    $sql = "SELECT CONCAT(u.nom,' ',u.prenom) as fulnameClient ,
            CONCAT(s.date_seances,' ',s.debut) as dateandtime,s.duree ,
            sp.type , st.type_status , st.style  From user u 
            INNER JOIN seances s ON s.id_client = u.id
            INNER JOIN sport sp ON sp.id_sport = s.id_sport
            INNER JOIN status st ON st.id_status = s.id_status
            WHERE  s.id_coach =:id ";
    $res = $conn ->prepare($sql);
    $res->execute([
        'id'=>$id_coach,
    ]);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}

function getseancesEnatt($id_coach , $ids){
    global $conn;
    $sql = "SELECT CONCAT(u.nom,' ',u.prenom) as fulnameClient ,
            CONCAT(s.date_seances,' ',s.debut) as dateandtime,s.id_secances, 
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


function updateStatusSeances($id_secances,$status){
    global $conn;
    $sql = "UPDATE seances SET id_status = :status where id_secances =:id_secances";
    $res = $conn ->prepare($sql);
    return $res->execute([
        'status'=>$status,
        'id_secances'=>$id_secances
    ]);
}


function updateAllSeancesTerminer(){
    global $conn;

    $sql = "
        UPDATE seances 
        SET id_status = 8 
        WHERE date_seances <= NOW()
        AND id_status != 8
    ";

    $rtes= $conn->prepare($sql);
    return $rtes->execute();
}



function updateSeancesEnattente($id_secances){
    global $conn;
    $sql = "UPDATE seances SET id_status = 9 where id_secances =:id_secances AND id_status = 5";
    $res = $conn ->prepare($sql);
    return $res->execute([
        'id_secances'=>$id_secances
    ]);
}

function updatesaeacnes($id_secances,$debut,$duree,$date_seances,$id_sport){
    global $conn;
    $sql = "UPDATE seances SET debut=:debut , duree=:duree , date_seances=:date_seances , id_sport=:id_sport
            where id_secances =:id_secances";
    $res = $conn ->prepare($sql);
    return $res->execute([
        'debut'=>$debut,
        'duree'=>$duree,
        'date_seances'=>$date_seances,
        'id_sport'=>$id_sport,
        'id_secances'=>$id_secances
    ]);
}

function getSeanceById($id_secances){
    global $conn;
    $sql = "SELECT * FROM seances WHERE id_secances = :id_secances";
    $res = $conn->prepare($sql);
    $res->execute([
        'id_secances'=>$id_secances
    ]);
    return $res->fetch(PDO::FETCH_ASSOC);
}