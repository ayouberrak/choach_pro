<?php

require_once __DIR__ . '/../config/config.php';

function selectRoles(){
    $conn = conect();
    $resquet ="SELECT * FROM role";
    $res = $conn->prepare($resquet);
    $res->execute();
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
function insertUser($nom,$prenom,$email,$password,$id_role){
    $conn = conect();
    $resquet ="INSERT INTO user(nom,prenom,email,password,id_role)
                VALUES(:nom,:prenom,:email,:password,:id_role)";
    $res =$conn->prepare($resquet);
    return $res->execute([
            'nom'=>$nom,
            'prenom'=>$prenom,
            'email'=>$email,
            'password'=>$password,
            'id_role'=>$id_role
    ]);
}


function insertClient($tel){
    $conn = conect();
    $resquet ="INSERT INTO client(telephone)
                VALUES(:telephone)";
    $res =$conn->prepare($resquet);
    return $res->execute([
            'telephone'=>$tel
    ]);
}


function insertCoach($biographie,$photo,$annees_experiance,$certification){
    $conn = conect();
    $resquet ="INSERT INTO coach(biographie,photo,annees_experiance,certification)
                VALUES(:biographie,:photo,:annees_experiance,:certification)";
    $res =$conn->prepare($resquet);
    return $res->execute([
            'biographie'=>$biographie,
            'photo'=>$photo,
            'annees_experiance'=>$annees_experiance,
            'certification'=>$certification
    ]);
}