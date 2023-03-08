<?php
    // Verifier si on a cliqué sur le bouton envoyer
    if(isset($_POST) && !empty($_POST)){
        // L'utilisateur a cliqué sur envoyer => Analyser le retour
        $h = array();
        $h['nom'] = $_POST['nom_ville'];

        $id_ville = $_POST['id_ville'];
        if($id_ville){
            // Modification
            sql_simple_update('t_ville',$id_ville,$h);
        }else{
            // Ajout
            sql_simple_insert('t_ville',$h);
        }

        header('location: index.php?page=listing_ville');
    }

    // Une verification si Ajout ou Modification d'un enregistrement
    if(isset($_GET['id'])){
        // Je suis en modification
        $id_ville = $_GET['id'];
        $data = build_r_from_id('t_ville',$id_ville);
        $title_page = 'Modification d\'une Ville';
    }else{
        // Je suis en Ajout
        $id_ville = 0;
        $data = array();
        $data['nom'] = '';
        $title_page = 'Ajout d\'une Ville';
    }

    // Generation du formulaire en HTML
    $html = '<div class="zone_contenu_clean"><br/><br/>';
    $html.= '    <div class="form-style">';
    if($id_ville){
        // Modification
        $html.= '        <h1>Modification Ville<span>Pour modifier la Ville, remplir ce formulaire...</span></h1>';
    }else{
        // Ajout
        $html.= '        <h1>Nouvelle Ville<span>Pour créer la Ville, remplir ce formulaire...</span></h1>';
    }

    // Debut du Formulaire HTML
    $html.= '        <form action="index.php?page=add_ville" method="post" enctype="multipart/form-data">';
    $html.= '           <div class="section"><span>1</span>Nom de la Ville</div>';
    $html.= '           <div class="inner-wrap">';

    // Input type text pour le nom du pays
    $html.= '               <label>Nom <input type="text" name="nom_ville" value="'.$data['nom'].'"/></label>';
    $html.= '           </div>';
    $html.= '           <div style="clear:both;"></div>';

    // Ajout champs caché
    $html.= '           <input type="hidden" name="id_ville" value="'.$id_ville.'" />';

    // Bouton Enregistrer
    $html.= '           <div class="button-section">';
    $html.= '               <input type="submit" name="Enregistrer" />';
    $html.= '           </div>';

    $html.= '       </form>';
    $html.= '   </div>';
    $html.= '</div>';
?>