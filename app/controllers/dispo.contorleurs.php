    <?php
    session_start();

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $id_coach=$_SESSION['user_id'];



    require_once __DIR__ .'/../models/dispo.models.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $jour = $_POST['jour'];
        $heures_debut =$_POST['debut'];
        $heures_fin =$_POST['fin'];

            

        if(!empty($jour) && !empty($heures_debut) && !empty($heures_fin)){
            $res=insertDispo($id_coach,$jour,$heures_debut,$heures_fin);
            if($res){
                header('Location: dispo.contorleurs.php?ajouter=yes');
                exit;
            }else{
                header('Location: dispo.contorleurs.php?ajouter=no');
                exit;
            }
        }else{
           header('Location: dispo.contorleurs.php?error=emtpy');
           
        }

    }
$dispo = getAllDispo($id_coach);




    require_once __DIR__ .'/../views/disponabilite.view.php';