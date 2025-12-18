<?php
    $env = parse_ini_file(__DIR__ .'/../../.env');

    
    define('DB_HOST',$env['DB_HOST']);
    define('DB_NAME',$env['DB_NAME']);
    define('DB_USER',$env['DB_USER']);
    define('DB_PASS',$env['DB_PASS']);
    
function conect(){


    try{
        $conn =new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4",DB_USER,DB_PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $conn;
    }catch(PDOException $e){
        echo 'erreur : '.$e->getMessage();
    }

}


function conn(){
    return conect();
}