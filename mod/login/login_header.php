<?php
$message_error = "";

// Test retour formulaire
if (isset($_POST) && !empty($_POST)) {
    // Verification login et mot de passe avec les données en BDD
    $login = $_POST['login'];
    $password = md5($_POST['password']);

    // Création de la requete SQL
    $sql = "SELECT * FROM t_user WHERE login='" . $login . "' LIMIT 1;";

    // Execution de la requete SQL
    $rs = query($sql);

    // Vérification si données présentes
    if ($rs && mysqli_num_rows($rs)) {
        $data = mysqli_fetch_assoc($rs);
        // Verification si Mot de passe OK
        if ($password == $data['password']) {
            // Enregistrement des informations en session
            $_SESSION[SITE_NAME]['id_user'] = $data['id'];
            $_SESSION[SITE_NAME]['nom_user'] = $data['username'];
            $_SESSION[SITE_NAME]['avatar'] = '';

            // Mettre à jour le statut de connexion de l'utilisateur à "En ligne"
            $sql_update = "UPDATE t_user SET status='En ligne' WHERE id='" . $data['id'] . "';";
            $rs_update = query($sql_update);

            // Redirection
            header("location: index.php");
        } else {
            $message_error = '<div class="login_ko">Mot de passe incorrect !</div>';
        }
    } else {
        $message_error = '<div class="login_ko">Login Introuvable</div>';
    }
}


// Creation du formulaire de connexion
$html = '<div class="container">';
$html .= '    <form action="index.php?page=home" method="POST">';
$html .= '       <p>Bienvenue</p>';
$html .= '       <input type="text" name="login" id="login" placeholder="Login"/><br>';
$html .= '       <input type="password" name="password" id="password" placeholder="Password"/><br/>';
$html .= '       <input type="submit" value="Connexion"><br>';
$html .= '   </form>';
$html .= '   <div class="drop drop-1"></div>';
$html .= '   <div class="drop drop-2"></div>';
$html .= '   <div class="drop drop-3"></div>';
$html .= '   <div class="drop drop-4"></div>';
$html .= '   <div class="drop drop-5"></div>';
$html .= '</div>';
$html .= $message_error;
