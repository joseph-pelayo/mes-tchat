<?php
$html_result = '';

if(isset($_FILES) && !empty($_FILES)) {
    // Etape 1.2. Génération d'un nom de fichier unique
    $tab_name = explode('.', $_FILES['form_file']['name']);
    $unique_name = uniqid('img_') . '.' . $tab_name[count($tab_name)-1];

    // Etape 1.3. Vérification de l'extension du fichier
    if(!preg_match('/\.(jpg|gif|png|jpeg)$/i',$_FILES['form_file']['name'])){
        $html_result = '<div class="result_form_ko" id="result_form_ko" onclick="document.getElementById(\'result_form_ko\').remove();">';
        $html_result .= '    Erreur ! Type fichier non supporté...<br/>';
        $html_result .= '</div>';
    }else{
        // Etape 1.4. Selection du repertoire et chemin du fichier uploadé
        $target_file = '../pic/upload/mosaic/' . $unique_name;

        // Etape 1.5. Gestion réel de l'upload
        if (move_uploaded_file($_FILES['form_file']['tmp_name'], $target_file)) {
            $mon_image = new Image($target_file);

            $mon_image->resizeByMin(64);
            $mon_image->cropSquare();
            $mon_image->store($target_file);
            $color = $mon_image->average(); //#45ef7b

            // Enregistrer les informations en BDD !
            $h = array();
            $h['nom_fichier'] = $unique_name;
            $r = hexdec(substr($color,0,2));
            $g = hexdec(substr($color,2,2));
            $b = hexdec(substr($color,4,2));
            $h['r'] = $r;
            $h['g'] = $g;
            $h['b'] = $b;

            sql_simple_insert('t_mosaic',$h);
            header('Location: index.php?page=import');
        }else{
            //Erreur Upload
            $html_result = '<div class="result_form_ko" id="result_form_ko" onclick="document.getElementById(\'result_form_ko\').remove();">';
            $html_result .= '    Erreur Upload !<br/>';
            $html_result .= '</div>';
        }
    }
}

$html = '<div class="zone_contenu_clean">';

// Formulaire de modification des informations de l'utilisateur
$html.= '   <div class="form-style">';
$html.= '       <h1>Upload Image<span>Pour ajouter une image remplir ce formulaire...</span></h1>';

// Formulaire de modification des information sur l'utilisateur
$html.= '       <form method="POST" action="index.php?page=upload_mosaic" enctype="multipart/form-data">';

// Titre et Image
$html.= '           <div class="section"><span>1</span>Fichier</div>';
$html.= '           <div class="inner-wrap">';
$html.= '               <label>Image <input type="file" name="form_file"/>\';</label>';
$html.= '           </div>';
$html.= '           <div style="clear:both;"></div>';

// Résultat Upload
$html.= '           <div class="section"><span>2</span>Informations Upload</div>';
$html.= '           <div class="inner-wrap">';
$html.= '               '.$html_result;
$html.= '           </div>';
$html.= '           <div style="clear:both;"></div>';

// Bouton Enregistrer
$html.= '           <div class="button-section">';
$html.= '               <input type="submit" name="Enregistrer" />';
$html.= '           </div>';

$html.= '       </form>';
$html.= '   </div>';
$html.= '</div>';


// Gestion des liens dans le header
$link = array(
    array(
        'image'=>'import.png',
        'text'=>'Import en <br/>masse',
        'url'=>'index.php?page=import',
    )
);


?>