<?php
require_once __DIR__ .'/../config/config.php';

function getsport(){
    $conn = conn();
    $sql = "SELECT * from sport ";
    $res = $conn->prepare($sql);
    $res->execute();
    return $res->fetchAll(PDO::FETCH_ASSOC);
}


function insertSport($id_sport, $id_coach): bool {
    $conn = conn();

    $check = $conn->prepare("
        SELECT 1 
        FROM sport_coach 
        WHERE id_sport = :id_sport AND id_coach = :id_coach
    ");
    $check->execute([
        'id_sport' => $id_sport,
        'id_coach' => $id_coach
    ]);

    if ($check->fetch()) {
        return false;
    }

    $sql = "INSERT INTO sport_coach (id_sport, id_coach) VALUES (:id_sport, :id_coach)";
    $res = $conn->prepare($sql);
    return $res->execute([
        'id_sport' => $id_sport,
        'id_coach' => $id_coach
    ]);
}



function insertSportnew($type) {
    if (empty($type)) return false;

    $conn = conn();

    $check = $conn->prepare("SELECT id_sport FROM sport WHERE type = :type");
    $check->execute(['type' => $type]);
    $existing = $check->fetchColumn();
    if ($existing) return $existing;

    $sql = "INSERT INTO sport(type) VALUES (:type)";
    $res = $conn->prepare($sql);
    $res->execute(['type' => $type]);
    return $conn->lastInsertId();
}


function getSportBycoach($id_coach){
    $conn = conn();
    $sql ="SELECT s.type , s.id_sport as sport_id FROM sport_coach sp 
    INNER JOIN sport s ON sp.id_sport = s.id_sport WHERE sp.id_coach =:id";
    $res = $conn->prepare($sql);
    $res->execute([
        'id'=>$id_coach
    ]);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}