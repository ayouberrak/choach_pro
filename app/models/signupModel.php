<?php

require_once __DIR__ . '/../config/config.php';

function selectRoles($conn){
    $resquet ="SELECT * FROM role";
    $res = $conn->prepare($resquet);
    $res->execute();
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
function insertUser($conn,$nom,$prenom,$email,$password,$id_role){
    $resquet ="INSERT INTO user(nom,prenom,email,password,id_role)
                VALUES(:nom,:prenom,:email,:password,:id_role)";
    $res =$conn->prepare($resquet);
    $ress = $res->execute([
            'nom'=>$nom,
            'prenom'=>$prenom,
            'email'=>$email,
            'password'=>$password,
            'id_role'=>$id_role
    ]);
        if($ress){
        return $conn->lastInsertId();
    }
    return false; 
}

function insertClient($conn,$id_client,$tel){
    $resquet ="INSERT INTO client(id_client,telephone)
                VALUES(:id_client,:telephone)";
    $res =$conn->prepare($resquet);
    return $res->execute([
            'id_client'=>$id_client,
            'telephone'=>$tel
    ]);
}


function insertCoach($conn,$id_coach,$biographie,$photo,$annees_experiance,$certification){
    $resquet ="INSERT INTO coach(id_coach,biographie,photo,annees_experiance,certification)
                VALUES(:id_coach,:biographie,:photo,:annees_experiance,:certification)";
    $res =$conn->prepare($resquet);
    return $res->execute([
            'id_coach'=>$id_coach,
            'biographie'=>$biographie,
            'photo'=>$photo,
            'annees_experiance'=>$annees_experiance,
            'certification'=>$certification
    ]);
}
