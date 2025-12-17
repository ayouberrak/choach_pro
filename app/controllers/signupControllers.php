<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../models/signupModel.php';
require_once __DIR__ . '/../config/config.php';

$conn = conn();
$roleSelect = selectRoles($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom     = trim($_POST['nom'] ?? '');
    $prenom  = trim($_POST['prenom'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $role    = $_POST['role'] ?? '';

    $biographie = $_POST['biographie'] ?? '';
    $photo = $_FILES['photo']['name'] ?? '';
    $annes_exepriances = $_POST['annes_exepriances'] ?? '';
    $certification = $_POST['certification'] ?? '';
    $tel = $_POST['tel'] ?? '';

    if (empty($nom) || empty($prenom) || empty($email) || empty($password) || empty($role)) {
        header("Location: signupControllers.php?error=empty");
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $userId = insertUser($conn,$nom, $prenom, $email, $hashedPassword, $role);

    if (!$userId) {
        header("Location: signupControllers.php?error=insertUser");
        exit();
    }

    if ($role == 2) {

        if (empty($biographie) || empty($annes_exepriances) || empty($certification) || empty($photo)) {
            header("Location: signupControllers.php?error=coach");
            exit();
        }
        $file_name = pathinfo($_FILES['photo']['name'], PATHINFO_FILENAME);
        $file_extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $alowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array(strtolower($file_extension), $alowed_extensions)) {
            header("Location: signupControllers.php?error=exetension");
            exit();
        }

        $new_file_name = $file_name . '_' . time() . '.' . $file_extension;
    $upload_dir = '../../public/uploadss/';


        $upload_path = $upload_dir . $new_file_name;

        if(move_uploaded_file($_FILES['photo']['tmp_name'], $upload_path)){
            insertCoach($conn,$userId, $biographie, $new_file_name, $annes_exepriances, $certification);
        } else {
            die("Upload failed! Check folder permissions, tmp folder & php.ini settings.");
        }
    }

    // 👥 CLIENT
    if ($role == 1) {

        if (empty($tel)) {
            header("Location: signupControllers.php?error=client");
            exit();
        }

        insertClient($conn,$userId,$tel);
    }

    header("Location: logincontoleur.php?success=1");
    exit();
}

// ✅ Affichage seulement en GET
require_once __DIR__ . '/../views/signView.php';
