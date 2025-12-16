    <?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    require_once __DIR__ . '/../models/signupModel.php';

    $conn =conn();
    $roleSelect =selectRoles($conn);



    // Detect registration by checking the register submit button
    if (isset($_POST['register_submit'])) {

        $nom = trim($_POST['nom'] ?? '');
        $prenom = trim($_POST['prenom'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $role = $_POST['roleSelect'] ?? null;

        $biographie = $_POST['biographie'] ?? '';
        $annes_exepriances = $_POST['annes_exepriances'] ?? '';
        $certification = $_POST['certification'] ?? '';

        $tel = $_POST['tel'] ?? '';
        
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);

        $required = ['nom' => $nom, 'prenom' => $prenom, 'email' => $email, 'password' => $password, 'roleSelect' => $role];
        $missing = [];
        foreach ($required as $k => $v) {
            if (empty($v) && $v !== 0 && $v !== '0') {
                $missing[] = $k;
            }
        }

        if (!empty($missing)) {
            echo 'Remplir les champs obligatoires: ' . implode(', ', $missing);
        } else {

            try {
                $ok = insertUser($conn,$nom,$prenom,$email,$password_hashed,$role);
                if (!$ok) {
                    $err = $conn->errorInfo();
                    echo 'Insert user failed: ' . json_encode($err);
                    exit;
                }
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
                

                
                $okCoach = insertCoach($conn,$id_user ,$biographie,$new_image_patch,$annes_exepriances,$certification);
                if (!$okCoach) {
                    $err = $conn->errorInfo();
                    echo 'Insert coach failed: ' . json_encode($err);
                    exit;
                }
                header('Location: login_signupControleur.php?signup=yes');
                exit;

            }elseif($role == 1 &&!empty($tel)){

                $okClient = insertClient($conn,$id_user,$tel);
                if (!$okClient) {
                    $err = $conn->errorInfo();
                    echo 'Insert client failed: ' . json_encode($err);
                    exit;
                }

                header('Location: login_signupControleur.php?signup=yes');
                exit;


            }
            } catch (PDOException $e) {
                echo 'DB error: ' . $e->getMessage();
                exit;
            }
        }
    }

    require_once __DIR__ . '/../views/signView.php';