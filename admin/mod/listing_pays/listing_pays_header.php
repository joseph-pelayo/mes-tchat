<?php
    // Verification si demande de suppression
    if(isset($_GET['id_suppr'])){
        $id_suppr = $_GET['id_suppr'];
        sql_simple_delete('t_pays',$id_suppr);
        header('location: index.php?page=listing_pays');
    }

    $title_page = 'Listing des Pays';

    // Etape 1 : Ecriture de la requete SQL
    $sql = "SELECT 
                    id, 
                    nom AS name
            FROM t_pays";

    // Etape 2 : Execution de la requete SQL sur le serveur MySQL
    $rs = query($sql);

    // Préparation de l'affichage du resultat
    $html = '<br/><br/><br/>';

    // Ajout d'un lien pour ajouter un pays
    $html.= '<div style="width:60%;text-align:right;margin:auto;margin-bottom:20px;">';
    $html.= '   <a href="index.php?page=add_pays"><img src="pic/interface/add_pays.png"></a>';
    $html.= '</div>';

    // Etape 3 : On verifie que la requete est bien executé ET qu'il y a des enregistrements en retour
    if($rs && mysqli_num_rows($rs)){
        // La requete est bien executé ET il y a des infos a traiter
        $html.= '<table class="main_table_listing" cellspacing="0" cellpadding="0">';

        // Premiere ligne du tableau
        $html.= '   <tr class="tab_header">';
        $html.= '       <td class="tab_td">ID</td>';
        $html.= '       <td class="tab_td">Nom Pays</td>';
        $html.= '       <td class="tab_td">&nbsp;</td>';
        $html.= '   </tr>';

        // Etape 4 : On parcours les resultats de la requete
        $i = 0;

        while($data = mysqli_fetch_assoc($rs)){
            $i++;
            // Boucle qui parcours les resultats de la requete
            if ($i % 2)
                $html .= '   <tr class="tab_row_1">';
            else
                $html .= '   <tr class="tab_row_2">';
            $html.= '       <td class="tab_td">'.$data['id'].'</td>';
            $html.= '       <td class="tab_td">'.$data['name'].'</td>';
            $html.= '       <td class="tab_td">';
            $html.= '            <a onclick="if(window.confirm(\'Etes vous sur ?\')) return true; else return false;" href="index.php?page=listing_pays&id_suppr='.$data['id'].'">';
            $html.= '                <img src="pic/interface/suppr.png">';
            $html.= '            </a>';
            $html.= '            <a href="index.php?page=add_pays&id='.$data['id'].'">';
            $html.= '                <img src="pic/interface/edit.png">';
            $html.= '            </a>';
            $html.= '        </td>';
            $html.= '   </tr>';
        }
        $html.= '</table>';
    }
?>