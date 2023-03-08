<?php
    $html_result = '';

    if(isset($_FILES) && !empty($_FILES)) {
        // Etape 1.2. Génération d'un nom de fichier unique
        $tab_name = explode('.', $_FILES['bg_mire']['name']);
        $unique_name = uniqid('img_') . '.' . $tab_name[count($tab_name)-1];

        // Etape 1.3. Vérification de l'extension du fichier
        if(!preg_match('/\.(jpg|gif|png|jpeg)$/i',$_FILES['bg_mire']['name'])){
            $html_result = '<div class="result_form_ko" id="result_form_ko" onclick="document.getElementById(\'result_form_ko\').remove();">';
            $html_result .= '    Erreur ! Type fichier non supporté...<br/>';
            $html_result .= '</div>';
        }else{
            // Etape 1.4. Selection du repertoire et chemin du fichier uploadé
            $target_file = 'pic/interface/bg/' . $unique_name;

            // Etape 1.5. Gestion réel de l'upload
            if (move_uploaded_file($_FILES['bg_mire']['tmp_name'], $target_file)) {
                // Purge de l'existant
                squery("DELETE FROM t_parametre WHERE code='mire_bg'");

                // Insertion
                $h = array();
                $h['code'] = 'mire_bg';
                $h['value'] = $unique_name;
                sql_simple_insert('t_parametre',$h);
                header('Location: index.php?page=home');

            }else{
                //Erreur Upload
                $html_result = '<div class="result_form_ko" id="result_form_ko" onclick="document.getElementById(\'result_form_ko\').remove();">';
                $html_result .= '    Erreur Upload !<br/>';
                $html_result .= '</div>';
            }
        }
    }




    // Generation du formulaire en HTML
    $html = '<div class="zone_contenu_clean"><br/><br/>';
    $html.= '    <div class="form-style">';
    $html.= '        <h1>Paramêtres<span>Pour modifier les paramêtres, merci de remplir formulaire...</span></h1>';

    // Debut du Formulaire HTML
    $html.= '        <form action="index.php?page=param" method="post" enctype="multipart/form-data">';
    $html.= '           <div class="section"><span>1</span>Mire de connexion</div>';
    $html.= '           <div class="inner-wrap">';

    // Input type text pour le nom du pays
    $html.= '               <label>Image Mire de connexion BO <input type="file" name="bg_mire" /></label>';
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