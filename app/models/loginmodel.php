<?php

require_once __DIR__ . '/../config/config.php';

error_reporting(E_ALL);

function ceckLogin($conn,$email,$password){
    $resquet ="SELECT * FROM user WHERE email=:email";
    $res =$conn->prepare($resquet);
    $res->execute([
        'email'=>$email
    ]);
    $user = $res->fetch(PDO::FETCH_ASSOC);
    if($user && password_verify($password, $user['password'])){
        return $user;
    }
    return false;
}