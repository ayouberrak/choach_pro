<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 1) {
    header("Location: ../controllers/logincontoleur.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard - FitCoach</title>
    <link rel="stylesheet" href="../../public/css/clientDash.css">
</head>
<body>
    <header>
        <h1>Bienvenue au tableau de bord du client</h1>
    </header>
    <main>
        <p>Contenu spécifique au client ici.</p>
    </main>
    <footer>
        <p>&copy; 2024 FitCoach. Tous droits réservés.</p>
    </footer>
</body>
</html>