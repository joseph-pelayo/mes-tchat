<?php

    // Verification si demande de suppression
    if(isset($_GET['id_suppr'])){
        $id_suppr = $_GET['id_suppr'];
        sql_simple_delete('piece',$id_suppr);
        header('location: index.php?page=listing_piece');
    }

    $title_page = 'Listing des pièces jointes';

    // Etape 1 : Ecriture de la requete SQL
    $sql = "SELECT 
                    p.id, 
                    p.data AS data,
                    t.libelle as type_piece,
                    p.message_id as message_id,
                    u.login as user
            FROM piece as p
            LEFT JOIN type_piece as t ON p.type_id = t.id
            LEFT JOIN message as m ON p.type_id = m.id
            LEFT JOIN t_user as u ON m.user_id = u.login;";
    
    // Etape 2 : Execution de la requete SQL sur le serveur MySQL
    $rs = query($sql);

    // Préparation de l'affichage du resultat
    $html = '<br/><br/><br/>';

    // Ajout d'un lien pour ajouter un pays
    // $html.= '<div style="width:60%;text-align:right;margin:auto;margin-bottom:20px;">';
    // $html.= '   <a href="index.php?page=add_user"><img src="pic/interface/add_user.png"></a>';
    // $html.= '</div>';

    // Etape 3 : On verifie que la requete est bien executé ET qu'il y a des enregistrements en retour
        // if(1){
    if($rs && mysqli_num_rows($rs)){
        // La requete est bien executé ET il y a des infos a traiter
        $html.= '<table class="main_table_listing" cellspacing="0" cellpadding="0">';

        // Premiere ligne du tableau
        $html.= '   <tr class="tab_header">';
        $html.= '       <td class="tab_td">ID</td>';
        $html.= '       <td class="tab_td">DATA</td>';
        $html.= '       <td class="tab_td">Type</td>';
        $html.= '       <td class="tab_td">ID message</td>';
        $html.= '       <td class="tab_td">User</td>';
        $html.= '       <td class="tab_td"> </td>';
        $html.= '   </tr>';

        // Etape 4 : On parcours les resultats de la requete
        $i = 0;
        // Data test
        $datas = [
            array('id' => '5','data' => 'a.pdf','type_piece'=> 'document','message_id'=> '125','user' => 'User1')
        ];
        // var_dump($datas);
        // exit();
        // foreach($datas as $data){
        while($data = mysqli_fetch_assoc($rs)){
            $i++;
            // Boucle qui parcours les resultats de la requete
            if ($i % 2)
                $html .= '   <tr class="tab_row_1">';
            else
                $html .= '   <tr class="tab_row_2">';
            $html.= '       <td class="tab_td">'.$data['id'].'</td>';
            $html.= '       <td class="tab_td">'.$data['data'].'</td>';
            $html.= '       <td class="tab_td">'.$data['type_piece'].'</td>';
            $html.= '       <td class="tab_td">'.$data['message_id'].'</td>';
            $html.= '       <td class="tab_td">'.$data['user'].'</td>';
            $html.= '       <td class="tab_td">';
            
            $html .= '            <a onclick="if(window.confirm(\'Etes vous sur ?\')) return true; else return false;" href="index.php?page=listing_piece&id_suppr=' . $data['id'] . '">';
            $html .= '                <img src="pic/interface/suppr.png">';
            $html .= '            </a>';

            // $html .= '            <a href="index.php?page=add_user&id=' . $data['id'] . '">';
            // $html .= '                <img src="pic/interface/edit.png">';
            // $html .= '            </a>';
            $html.= '        </td>';


            $html.= '   </tr>';
        }
        $html.= '</table>';
    }

    // $html='';
?>