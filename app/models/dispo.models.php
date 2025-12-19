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


// function getDispo(){
//     global $conn;
//     $sql = "SELECT * "
// }