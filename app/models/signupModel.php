<?php

require_once __DIR__ . '/../config/config.php';

function selectRoles(){
    $conn = conect();
    $resquet ="SELECT * FROM role";
    $res = $conn->prepare($resquet);
    $res->execute();
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
