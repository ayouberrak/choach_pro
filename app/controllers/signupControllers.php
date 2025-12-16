<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . '/../models/signupModel.php';

$conn =conn();
$roleSelect =selectRoles($conn);



if($_SERVER['REQUEST_METHOD']=== 'POST'){


    $nom =$_POST['nom'];
    $prenom =$_POST['prenom'];
    $email =$_POST['email'];
    $password =$_POST['password'];
    $role =$_POST['role'];

    $biographie =$_POST['biographie'];
    $annes_exepriances =$_POST['annes_exepriances'];
    $certification =$_POST['certification'];

    $tel =$_POST['tel'];
    
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    if(!empty($nom) && !empty($prenom) && !empty($email) && !empty($password_hashed) && !empty($role)){

        insertUser($conn,$nom,$prenom,$email,$password_hashed,$role);
        $id_user = $conn->lastInsertId();

        if($role == 2 && !empty($biographie) && !empty($annes_exepriances) && !empty($certification) ){

            $upload_dir = __DIR__ . '/../uploads/';  

            if(empty($_FILES['photo']['tmp_name'])){
                header('Location: signupControllers.php?signup=entre_images');
                exit;
            }


            $file_name = pathinfo($_FILES['photo']['name'],PATHINFO_FILENAME);
            $file_path =pathinfo($_FILES['photo']['name'],PATHINFO_EXTENSION);
            $new_image_patch = $file_name.'_'.date("Ymd_His").".".$file_path;


            $allowed_extensions = ['jpg','jpeg','png','gif'];
            if(!in_array(strtolower($file_path), $allowed_extensions)){
                header('Location: signupControllers.php?signup=image_invalid_ex');
                exit;
            }

            $full_path = $upload_dir . $new_image_patch;
             
            if(!move_uploaded_file($_FILES['photo']['tmp_name'], $full_path)){
                header('Location: signupControllers.php?signup=uploades_nexicte_pas');
                exit;
            }

            insertCoach($conn,$id_user ,$biographie,$new_image_patch,$annes_exepriances,$certification);
            header('Location: signupControllers.php?signup=yes');
            exit;

        }elseif($role == 1 &&!empty($tel)){

            insertClient($conn,$id_user,$tel);
            header('Location: signupControllers.php?signup=yes');
            exit;


        }
    }else{  
        echo "rempli les champs";
    }
}

require_once __DIR__ . '/../views/signView.php';