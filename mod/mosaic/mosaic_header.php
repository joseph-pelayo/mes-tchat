<?php
// Preparation des variables pour informations utilisateurs
$message = "";
$message_img = '';
$message_error = '';

if(isset($_FILES) && !empty($_FILES) && !empty($_FILES['my_file']['name'])){

    $uploaddir = 'pic/upload/mosaic_brut/';
    $uploadfile = $uploaddir . basename($_FILES['my_file']['name']);
    if (move_uploaded_file($_FILES['my_file']['tmp_name'], $uploadfile)) {
        // Generation d'un nom unique
        $tab_name = explode('.',$_FILES['my_file']['name']);
        $unique_name = uniqid('img_').'.'.$tab_name[1];

        // Gestion de la taille des images et génération de l'apercu (petite image...)
        $myImg = new image($uploadfile);

        // Ajustement de la taille de l'image
        if(isset($_POST['force_resize']) && $_POST['force_resize'])
            $myImg->resizeByFactor(10);

        // Enregistrement de l'image
        $myImg->store($uploaddir.$unique_name);

        // On libère la memoire du serveur.
        unset($myImg);

        // Nettoyage de l'ancien fichier
        @unlink($uploadfile);

        // Etape 3
        // Gestion de la creation de l'image mosaic....
        $img_origine = imagecreatefromjpeg($uploaddir.$unique_name);

        // Etape 4
        $taille_x = imagesx($img_origine);
        $taille_y = imagesy($img_origine);

        // Etape 5
        $new_x = $taille_x * 64;
        $new_y = $taille_y * 64;

        // Etape 6
        // Création de l'image mosaic
        $mosaic = imageCreateTrueColor($new_x, $new_y);

        // Etape 7
        // Parcours de l'image d'origine pixel par pixel
        for($i = 0; $i< $taille_x; $i++){
            for($j=0; $j< $taille_y; $j++){
                // Pour chaque pixel, on récupère la couleur
                // Etape 7.2
                $color_origine = imagecolorat($img_origine, $i, $j);

                $rd = ($color_origine >> 16) & 0xFF;
                $gd = ($color_origine >> 8) & 0xFF;
                $bd = $color_origine & 0xFF;

                // Version SQL
                $sql = "SELECT  
                            nom_fichier, 
                            (
                                 (
                                      (  
                                          ABS(".$rd." - r) / 255 
                                      ) + 
                                      ( 
                                          ABS(".$gd." - g) / 255 
                                      ) + 
                                      ( 
                                          ABS(".$bd." - b) / 255 
                                      )   
                                 ) / 3 * 100 
                             ) AS pourcentage 
                             FROM 
                                 t_mosaic 
                             WHERE 
                                 r IS NOT NULL 
                                 AND g IS NOT NULL 
                                 AND b IS NOT NULL 
                             ORDER BY pourcentage ASC 
                             LIMIT 1";
                $rs = query($sql);
                $data = mysqli_fetch_assoc($rs);
                $url = $data['nom_fichier'];


                if($data['nom_fichier'] && is_file('pic/upload/mosaic/'.$data['nom_fichier'])) {


                    $img_bdd = imagecreatefromstring(file_get_contents('pic/upload/mosaic/'.$data['nom_fichier']));
                    imagecopy($mosaic, $img_bdd, $i*64, $j*64, 0, 0, 64, 64);
                    // Gestion couche alpha
                    if(isset($_POST['force_alpha']) && $_POST['force_alpha'] && $data['pourcentage'] > 1) {
                        $force_alpha = $_POST['hidden_alpha'];

                        $couche = imagecolorallocatealpha($mosaic, $rd, $gd, $bd, $force_alpha);
                        imagefilledrectangle($mosaic, $i * 64, $j * 64, ($i * 64) + 64, ($j * 64) + 64, $couche);
                    }
                    unset($img_bdd);
                }else{
                    $message_error.= 'Erreur fichier <a href="pic/upload/mosaic/'.$data['nom_fichier'].'">'.$data['nom_fichier'].'</a><br/>';
                }
            } // fin boucle for ($j...
        } // fin boucle for ($i...

        // Enregistrement image mosaic
        ImageJPEG($mosaic, 'pic/upload/mosaic_generate/'.$unique_name,95);

        // Préparation du message d'information (en cas de réussite)
        $message.= '<div class="upload_ok" onclick="$(this).hide();">';
        $message.= '    Génération Mosaic Réussi !';
        $message.= '</div>';

        $message_img = '<div class="apercu_img" >';
        $message_img.= '    <img src="pic/upload/mosaic_generate/'.$unique_name.'" style="width:640px; height: auto; margin: auto;" />';
        $message_img.= '</div>';
    } else {
        // Préparation du message d'information (en cas d'errreur)
        $message = '<div class="upload_ko" onclick="$(this).hide();">';
        $message.= '    Erreur Génération Mosaic !';
        $message.= '</div>';
    }
}

// Génération du code HTML pour le formulaire d'upload d'un fichier image
$html = '<div class="zone_contenu_clean">';
$html.= '   <div class="form-style">';
$html.= '       <h1>Mosaic<span>Création d\'une mosaic d\'image...</span></h1>';
$html.= '       <form action="index.php?page=mosaic" method="POST" enctype="multipart/form-data" id="myForm" name="myForm">';
$html.= '           <div class="section"><span>1</span>Upload image originale</div>';
$html.= '           <div class="inner-wrap">';
$html.= '               <label>Image de départ <input type="file" name="my_file" id="my_file"/></label>';
$html.= '           </div>';

// Section 2 : Options
$html.= '           <div class="section"><span>2</span>Options</div>';
$html.= '           <div class="inner-wrap">';
$html.= '               <label>Décocher la case pour NE PAS modifier la taille de l\'image d\'origine (Risque Saturation de la mémoire du Serveur)<input type="checkbox" name="force_resize" id="force_resize" value="1" checked="checked" /></label>';
$html.= '               <label>Optimiser le traitement avec une couche Alpha  <input type="checkbox" name="force_alpha" id="force_alpha" value="1" checked="checked" /></label>';
$html.= '               <label>Intensité de la couche Alpha <div id="slider"></div><div class="info_slider"><div class="info_left">Transparent</div><div class="info_right">Opaque</div></div></label>';
$html.= '               <input type="hidden" id="hidden_alpha" name="hidden_alpha" value="40" />';
$html.= '           </div>';
$html.= '           <div class="button-section">';
$html.= '               <input type="submit" name="Enregistrer" />';
$html.= '           </div>';
$html.= '       </form>';
$html.= '       '.$message;
$html.= '       '.$message_img;
if(!empty($message_error)){
    $html.= '          <div class="upload_ko">';
    $html.= '              '.$message_error;
    $html.= '          </div>';
}
$html.= '     </div>';
$html.= '</div>';


?>