<?php
    // Gestion de la suppression d'une image
    if(isset($_GET['id_suppr']) && !empty($_GET['id_suppr'])){
        $id_photo = $_GET['id_suppr'];

        // Supression de l'image
        $file = squery("SELECT nom_fichier FROM t_photo WHERE id=".$id_photo);
        @unlink('pic/galerie/'.$file);

        // Supression enregistrement BDD
        sql_simple_delete('t_photo',$id_photo);

        // Rechargement de la page
        header('Location: index.php?page=galerie');
    }
    // Afficher le contenu de la table t_photo
    // Pour chaque image de la table t_photo il faut afficher l'image (en HTML) ,son titre, le nom de l'utilisateur qui a pris la photo

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

    $title_page = 'Galerie';

    $html = '<div class="zone_display_photo">';
    // Etape 3 : On verifie que la requete est bien executé ET qu'il y a des enregistrements en retour
    if($rs && mysqli_num_rows($rs)){

        // Etape 4 : On parcours les resultats de la requete
        while($data = mysqli_fetch_assoc($rs)){
            $html.= '<div class="cadre_photo">';
            $html.= '   <div class="apercu_photo" style="background-image: url(../pic/upload/galerie/'.$data['nom_fichier'].');"></div>';
            $html.= '   <div class="titre_photo">';
            $html.= '       '.$data['titre'];
            $html.= '   </div>';
            $html.= '   <div class="nom_photographe">';
            $html.= '       <div class="suppr_photo">';
            $html.= '           <a onclick="if(window.confirm(\'Etes vous sur ?\')) return true; else return false;" href="index.php?page=galerie&id_suppr='.$data['id_photo'].'">';
            $html.= '               <img src="pic/interface/suppr.png" />';
            $html.= '           </a>';
            $html.= '       </div>';
            $html.= '       '.$data['username'];
            $html.= '   </div>';
            $html.= '</div>';
        }
    }
    $html.= '</div>';

    // Gestion des liens dans le header
    $link = array(
        array(
            'image'=>'upload.png',
            'text'=>'Ajouter une <br/>Image',
            'url'=>'index.php?page=upload',
        )
    );
?>