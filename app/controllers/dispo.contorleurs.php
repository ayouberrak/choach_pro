    <?php
    session_start();

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $id_coach=$_SESSION['user_id'];
// require_once __DIR__ . '/../api/dispo.api.php';


    require_once __DIR__ .'/../models/dispo.models.php';




    require_once __DIR__ .'/../views/disponabilite.view.php';