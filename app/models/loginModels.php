<?php
require_once __DIR__ . '/../config/config.php';

function conn(){
    return conect();
}


function checkLogin($conn,$email,$password){
    $pasword_hash = password_hash($password,PASSWORD_DEFAULT);
    $res = $conn->prepare("SELECT * FROM users WHERE email = :email AND password = :pasword_hash");
    $res->execute([
        'email'=>$email,
        'pasword_hash'=>$pasword_hash
    ]);
    return $res->fetch(PDO::FETCH_ASSOC);
}