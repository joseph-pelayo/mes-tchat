<?php
// Ajout d'un message

// Verifier si on a cliqué sur le bouton envoyer
if(isset($_POST) && !empty($_POST)){
    // L'utilisateur a cliqué sur envoyer => Analyser le retour
    $h_message = array();
    $h_message['message'] = $_POST['form_nom'];
    $h_message['date'] = date("Y-m-d H:i:s");
    $h_message['user_id'] = $_SESSION[SITE_NAME]['id_user'];

}

?>