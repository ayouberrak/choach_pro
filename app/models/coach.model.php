<?php


require_once __DIR__ ."/../config/config.php";


function getcoachby($conn, $id){
    $sql = "SELECT u.nom,u.prenom ,u.email,u.password , co.*  FROM user u inner JOIN coach co ON u.id = co.id_coach WHERE co.id_coach = :id_coach";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id_coach' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}



function updatecoach($conn, $id_coach, $nom, $prenom, $email, $password, $annees_experiance, $certification, $bio){
    $sql = "UPDATE user u 
            INNER JOIN coach c ON u.id = c.id_coach 
            SET u.nom = :nom, u.prenom = :prenom, u.email = :email, u.password = :password,c.biographie = :bio,c.annees_experiance= :annees_experiance , c.certification= :certification 
            WHERE c.id_coach = :id_coach";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'password' => $password,
        'annees_experiance' => $annees_experiance,
        'certification' => $certification,
        'id_coach' => $id_coach,
        'bio' => $bio
    ]);
}