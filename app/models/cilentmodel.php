<?php

require_once __DIR__ ."/../config/config.php";
$conn = conn();

function getcoach(){
    global $conn;
    $sql = "SELECT u.nom,u.prenom , co.*  FROM user u inner JOIN coach co ON u.id = co.id_coach";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



function getCountClient($id_coach){

}


// function getsport(){
//     $sql = "SELECT * from sport"; 
// }



