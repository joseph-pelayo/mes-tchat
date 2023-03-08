<?php
    // Gestion et initialisation des erreurs et de l'encodage (UTF8)
    ini_set('session.gc_maxlifetime', 7200);
    ini_set('default_charset', 'utf-8');
    mb_internal_encoding("UTF-8");
    @error_reporting(E_ALL ^ E_DEPRECATED);

    // inclusion du moteur
    include 'inc/framework.php';

    // Gestion et initialisation des sessions
    session_name(SITE_NAME);
    session_start();

    // Exemple => index.php?page=galerie
    // $_GET['page'] === galerie
    // $page[$_GET['page']] === $page['galerie']
    if(isset($_SESSION[SITE_NAME]) && !empty($_SESSION[SITE_NAME]['id_user'])) {
        if (!empty($_GET['page']) && isset($page[$_GET['page']])) {
            // La page existe dans la gestion des routes
            $url_php = $page[$_GET['page']];
        } else {
            // page inconnu
            $url_php = $page['home'];
        }
    } else {
        $url_php = $page['login'];
    }

    // Gestion des headers (PHP)
    // $url_php => 'mod/home/home.php'
    // $url_php_header => 'mod/home/home_header.php'
    $url_php_header = str_replace('.php','_header.php', $url_php);
    if(is_file($url_php_header)){
        include $url_php_header;
    }


?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Meta -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        <meta name="mobile-web-app-capable" content="yes">

        <!-- Style CSS -->
        <link rel="stylesheet" type="text/css" href="css/interface.css"/>

        <?php
            // Gestion du fichier _head
            // $url_php => 'mod/home/home.php'
            // $url_php_head => 'mod/home/home_head.php'
            $url_php_head = str_replace('.php','_head.php', $url_php);
            if(is_file($url_php_head)){
                include $url_php_head;
            } else {
                echo '<title>First BDD !</title>';
            }

        ?>
        <!-- Polices Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&display=swap" rel="stylesheet" />
        <link href='http://fonts.googleapis.com/css?family=Bitter' rel='stylesheet' type='text/css'>
    </head>
    <?php
        include $url_php;
    ?>
</htmsl>
