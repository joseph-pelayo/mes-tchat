<?php
    // Verifier si on a cliqué sur le bouton envoyer
    if(isset($_POST) && !empty($_POST)){
        // L'utilisateur a cliqué sur envoyer => Analyser le retour
        $nom_pays = $_POST['nom_pays'];

        $h = array();
        $h['nom'] = $nom_pays;

        $id_pays = $_POST['id_pays'];
        if($id_pays){
            // Modification
            sql_simple_update('t_pays',$id_pays,$h);
        }else{
            // Ajout
            sql_simple_insert('t_pays',$h);
        }

        header('location: index.php?page=listing_pays');
    }

    // Une verification si Ajout ou Modification d'un enregistrement
    if(isset($_GET['id'])){
        // Je suis en modification
        $id_pays = $_GET['id'];
        $data = build_r_from_id('t_pays',$id_pays);
        $title_page = 'Modification d\'un Pays';
    }else{
        // Je suis en Ajout
        $id_pays = 0;
        $data = array();
        $data['nom'] = '';
        $title_page = 'Ajout d\'un Pays';
    }

    // Generation du formulaire en HTML
    $html = '<div class="zone_contenu_clean"><br/><br/>';
    $html.= '    <div class="form-style">';
    if($id_pays) {
        $html .= '        <h1>Modification Pays<span>Pour modifier le pays, remplir ce formulaire...</span></h1>';
    }else{
        $html .= '        <h1>Nouveau Pays<span>Pour créer le pays, remplir ce formulaire...</span></h1>';
    }

    // Debut du Formulaire HTML
    $html.= '        <form action="index.php?page=add_pays" method="post" enctype="multipart/form-data">';
    $html.= '           <div class="section"><span>1</span>Nom du Pays</div>';
    $html.= '           <div class="inner-wrap">';

    // Input type text pour le nom du pays
    $html.= '               <label>Nom <input type="text" name="nom_pays" value="'.$data['nom'].'"/></label>';
    $html.= '           </div>';
    $html.= '           <div style="clear:both;"></div>';

    // Ajout champs caché
    $html.= '           <input type="hidden" name="id_pays" value="'.$id_pays.'" />';

    // Bouton Enregistrer
    $html.= '           <div class="button-section">';
    $html.= '               <input type="submit" name="Enregistrer" />';
    $html.= '           </div>';

    $html.= '       </form>';
    $html.= '   </div>';
    $html.= '</div>';
?>