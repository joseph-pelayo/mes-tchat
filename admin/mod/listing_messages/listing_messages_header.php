<?php

    // Etape 0 : Verification si demande de suppression
    if(isset($_GET['id_suppr'])){
        $id_suppr = $_GET['id_suppr'];
        sql_simple_delete('t_user',$id_suppr);
        header('location: index.php?page=listing_user');
    }

    $title_page = 'Listing des Messages';

    // Etape 1 : Ecriture de la requete SQL
    $sql = "SELECT  message.id as msg_id,
                    message.message as user_msg, 
                    message.date as msg_date,
                    message.id,
                    t_user.username as username, 
                    message.salon_id,
                    salon.name as salon_nom
            FROM message
            INNER JOIN salon ON salon.id = message.salon_id
            INNER JOIN t_user ON  t_user.id = message.user_id";

    // Etape 2 : Execution de la requete SQL sur le serveur MySQL
    $rs = query($sql);

    // Préparation de l'affichage du resultat
    $html = '<br/><br/><br/>';

    // Ajout d'un lien pour ajouter un message
    // $html.= '<div style="width:60%;text-align:right;margin:auto;margin-bottom:20px;">';
    // $html.= '   <a href="index.php?page=add_user"><img src="pic/interface/add_user.png"></a>';
    // $html.= '</div>';

    // Etape 3 : On verifie que la requete est bien executé ET qu'il y a des enregistrements en retour
    if($rs && mysqli_num_rows($rs)){
        // La requete est bien executé ET il y a des infos a traiter
        $html.= '<table class="main_table_listing" cellspacing="0" cellpadding="0">';

        // Premiere ligne du tableau
        $html.= '   <tr class="tab_header">';
        $html.= '       <td class="tab_td">ID</td>';
        $html.= '       <td class="tab_td">Nom utilisateur</td>';
        $html.= '       <td class="tab_td">Message</td>';
        $html.= '       <td class="tab_td">Date publication</td>';
        $html.= '       <td class="tab_td">Salon</td>';
        $html.= '       <td class="tab_td"></td>';
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
            $html.= '       <td class="tab_td">'.$data['msg_id'].'</td>';
            $html.= '       <td class="tab_td">'.$data['username'].'</td>';
            $html.= '       <td class="tab_td">'.$data['user_msg'].'</td>';
            $date = new DateTime($data['msg_date']);
            $html.= '       <td class="tab_td">'.$date->format('d-m-Y H:i').'</td>';
            $html.= '       <td class="tab_td">'.$data['salon_nom'].'</td>';
            $html.= '       <td class="tab_td">';
            if($_SESSION[SITE_NAME]['id_user'] != $data['id']) {
                $html .= '            <a onclick="if(window.confirm(\'Etes vous sur ?\')) return true; else return false;" href="index.php?page=listing_messages&id_suppr=' . $data['id'] . '">';
                $html .= '                <img src="pic/interface/suppr.png">';
                $html .= '            </a>';
            }
            $html.= '        </td>';


            $html.= '   </tr>';
        }

        $html.= '</table>';
    }

?>