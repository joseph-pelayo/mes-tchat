<?php
// Mettre à jour le statut de connexion de l'utilisateur à "Hors ligne"
$sql_update = "UPDATE t_user SET status='Hors ligne' WHERE id='" . $_SESSION[SITE_NAME]['id_user'] . "';";
$rs_update = query($sql_update);

// Déconnexion de l'utilisateur
unset($_SESSION[SITE_NAME]);
session_destroy();

// Redirection
header("location: login.php");
