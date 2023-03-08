<?php
    // Etape 1 : Ecriture de la requete SQL
    $sql = 'SELECT 
                    p.id AS id_photo,
                    p.nom_fichier,
                    p.titre,
                    u.username
                FROM t_photo p
                LEFT JOIN t_user u ON u.id = p.fk_user';

    // Etape 2 : Execution de la requete SQL sur le serveur MySQL
    $rs = query($sql);

    $html = '<h1 class="main_title">Galerie</h1>';
    $html.= '<div class="zone_display_photo">';
    // Etape 3 : On verifie que la requete est bien executé ET qu'il y a des enregistrements en retour
    if($rs && mysqli_num_rows($rs)){

        // Etape 4 : On parcours les resultats de la requete
        while($data = mysqli_fetch_assoc($rs)){
            $html.= '<div class="cadre_photo" onclick="location.href = \'pic/upload/galerie/big/'.$data['nom_fichier'].'\';">';
            $html.= '   <div class="apercu_photo" style="background-image: url(pic/upload/galerie/'.$data['nom_fichier'].');"></div>';
            $html.= '   <div class="titre_photo">';
            $html.= '       '.$data['titre'];
            $html.= '   </div>';
            $html.= '   <div class="nom_photographe">';
            $html.= '       '.$data['username'];
            $html.= '   </div>';
            $html.= '</div>';
        }
    }
    $html.= '</div>';

?>