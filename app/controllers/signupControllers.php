<?php

require_once __DIR__ . '/../models/signupModel.php';

$roleSelect =selectRoles();


if($_SERVER['REQUEST_METHOD']=== 'POST'){
    $nom =$_POST['nom'];
    $prenom =$_POST['prenom'];
    $email =$_POST['email'];
    $password =$_POST['password'];
    $role =$_POST['role'];

    $biographie =$_POST['biographie'];
    $photo =$_POST['photo'];
    $annes_exepriances =$_POST['annes_exepriances'];
    $certification =$_POST['certification'];
    $tel =$_POST['tel'];
    
}



require_once __DIR__ . '/../views/signView.php';