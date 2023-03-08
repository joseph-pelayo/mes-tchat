<?php
$html_result = '';

// Verification si retour d'un formulaire $_POST
if( isset($_POST)  && !empty($_POST)){
    // Etape 1. Gestion du fichier uploader

    // Etape 1.1. Test si fichier saisi par l'utilisateur
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
            $target_file = '../pic/upload/galerie/' . $unique_name;
            $target_file_big = '../pic/upload/galerie/big/' . $unique_name;

            // Etape 1.5. Gestion réel de l'upload
            if (move_uploaded_file($_FILES['form_file']['tmp_name'], $target_file)) {
                $mon_image = new Image($target_file);

                // Gestion de l'enregistrement de la grande image (sans redimension)
                $mon_image->store($target_file_big);

                if($mon_image->getSizeX() > 450 || $mon_image->getSizeY() > 450){
                    $mon_image->resizeByMin(450);
                }
                $mon_image->store($target_file);

                // Enregistrer les informations en BDD !
                $h = array();
                $h['titre'] = $_POST['form_title'];
                $h['nom_fichier'] = $unique_name;
                $h['ordre'] = squery('SELECT IFNULL(MAX(ordre) + 1,1) FROM t_photo');
                $h['fk_user'] = $_SESSION[SITE_NAME]['id_user'];


                sql_simple_insert('t_photo',$h);
                header('Location: index.php?page=galerie');
            }else{
                //Erreur Upload
                $html_result = '<div class="result_form_ko" id="result_form_ko" onclick="document.getElementById(\'result_form_ko\').remove();">';
                $html_result .= '    Erreur Upload !<br/>';
                $html_result .= '</div>';
            }
        }
    }
}

$html = '<div class="zone_contenu_clean">';

// Formulaire de modification des informations de l'utilisateur
$html.= '   <div class="form-style">';
$html.= '       <h1>Upload Image<span>Pour ajouter une image remplir ce formulaire...</span></h1>';

// Formulaire de modification des information sur l'utilisateur
$html.= '       <form method="POST" action="index.php?page=upload" enctype="multipart/form-data">';

// Titre et Image
$html.= '           <div class="section"><span>1</span>Titre et Fichier</div>';
$html.= '           <div class="inner-wrap-l">';
$html.= '               <label>Titre <input type="text" name="form_title" value=""/></label>';
$html.= '           </div>';
$html.= '           <div class="inner-wrap-r">';
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





?>