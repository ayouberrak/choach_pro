<?php
session_start();
$_SESSION = [];
session_destroy();
header("Location: logincontoleur.php");
exit;
?>
