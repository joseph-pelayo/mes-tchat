<?php
    // Verifier si on a cliqué sur le bouton envoyer
    if(isset($_POST) && !empty($_POST)){
        // L'utilisateur a cliqué sur envoyer => Analyser le retour
        $h = array();
        $h['username'] = $_POST['form_nom'];
        $h['user_email'] = $_POST['form_email'];
        $h['login'] = $_POST['form_login'];
        if(!empty($_POST['form_password']))
            $h['password'] = md5($_POST['form_password']);
        $h['adresse'] = $_POST['form_adresse'];
        $h['code_postal'] = $_POST['form_cp'];
        $h['fk_ville'] = $_POST['form_ville'];
        $h['fk_pays'] = $_POST['form_pays'];


        // Gestion de l'upload
        if(isset($_FILES) && !empty($_FILES) && !empty($_FILES['form_avatar']['name'])){
            // L'utilisateur a voulu uploader un fichier
            // background.jpg => $tab_name[0] = background / $tab_name[1] =jpg
            $tab_name = explode('.', $_FILES['form_avatar']['name']);
            $unique_name = uniqid('img_').'.'.$tab_name[count($tab_name)-1];

            $upload_dir = 'pic/avatar/';
            $upload_file = $upload_dir.$unique_name;

            // Upload réel
            if(move_uploaded_file($_FILES['form_avatar']['tmp_name'], $upload_file)){
                $monImage = new Image($upload_file);
                $monImage->resizeByMin(64);
                $monImage->cropSquare();
                $monImage->store($upload_file);

                $h['avatar'] = $unique_name;
            }
        }




        $id_user = $_POST['id_user'];
        if($id_user) {
            sql_simple_update('t_user',$id_user,$h);
        }else{
            sql_simple_insert('t_user', $h);
        }
        header('location: index.php?page=listing_user');
    }

    // Une verification si Ajout ou Modification d'un enregistrement
    if(isset($_GET['id'])){
        // Je suis en modification
        $id_user = $_GET['id'];
        $data = build_r_from_id('t_user',$id_user);
        $title_page = 'Modification d\'un Utilisateur';
    }else{
        // Je suis en Ajout
        $id_user = 0;
        $data = array();
        $data['username'] = '';
        $data['user_email'] = '';
        $data['login'] = '';
        $data['password'] = '';
        $data['adresse'] = '';
        $data['code_postal'] = '';
        $data['fk_ville'] = 0;
        $data['fk_pays'] = 0;
        $title_page = 'Ajout d\'un Utilisateur';
    }


    // Generation du formulaire en HTML
    $html = '<div class="zone_contenu_clean"><br/><br/>';
    $html.= '    <div class="form-style">';

    if($id_user) {
        $html .= '        <h1>Modification Utilisateur<span>Pour modifier un utilisateur, remplir ce formulaire...</span></h1>';
    }else{
        $html .= '        <h1>Nouvel Utilisateur<span>Pour créer un utilisateur, remplir ce formulaire...</span></h1>';
    }

    // Debut du Formulaire HTML
    $html.= '        <form action="index.php?page=add_user" method="post" enctype="multipart/form-data">';

    // Input type text pour le nom et email
    $html.= '           <div class="section"><span>1</span>Nom et email</div>';
    $html.= '           <div class="inner-wrap-l">';
    $html.= '               <label>Nom <input type="text" name="form_nom" value="'.$data['username'].'"/></label>';
    $html.= '           </div>';
    $html.= '           <div class="inner-wrap-r">';
    $html.= '               <label>Email <input type="email" name="form_email" value="'.$data['user_email'].'"/></label>';
    $html.= '           </div>';
    $html.= '           <div style="clear:both;"></div>';

    // Input type text pour le login et mot de passe
    $html.= '           <div class="section"><span>2</span>Login et Mot de passe</div>';
    $html.= '           <div class="inner-wrap-l">';
    $html.= '               <label>Login <input type="text" name="form_login" value="'.$data['login'].'"/></label>';
    $html.= '           </div>';
    $html.= '           <div class="inner-wrap-r">';
    $html.= '               <label>Mot de passe <input type="password" name="form_password" value=""/></label>';
    $html.= '           </div>';
    $html.= '           <div style="clear:both;"></div>';

    // Input pour l'adresse
    $html.= '           <div class="section"><span>3</span>Adresse</div>';
    $html.= '           <div class="inner-wrap-l">';
    $html.= '               <label>Adresse <input type="text" name="form_adresse" value="'.$data['adresse'].'"/></label>';
    $html.= '               <label>Code postal <input type="text" name="form_cp" value="'.$data['code_postal'].'"/></label>';
    $html.= '           </div>';
    $html.= '           <div class="inner-wrap-r">';
    $html.= '               <label>Ville';
    $html.= '                   <select name="form_ville">';
    $html.= '                       <option value="0">-- Selection Ville --</option>';

    $sql = "SELECT * FROM t_ville ORDER BY nom ASC";
    $rs = query($sql);
    if($rs && mysqli_num_rows($rs)){
        while($data_ville = mysqli_fetch_assoc($rs)){
            if($data_ville['id'] == $data['fk_ville']) {
                $html .= '                        <option value="' . $data_ville['id'] . '" selected>' . $data_ville['nom'] . '</option>';
            }else{
                $html.= '                        <option value="'.$data_ville['id'].'">'.$data_ville['nom'].'</option>';
            }
        }
    }
    $html.= '                   </select>';
    $html.= '               </label>';
    $html.= '               <label>Pays';
    $html.= '                   <select name="form_pays">';
    $html.= '                       <option value="0">-- Selection Pays --</option>';
    $sql = "SELECT * FROM t_pays ORDER BY nom ASC";
    $rs = query($sql);
    if($rs && mysqli_num_rows($rs)){
        while($data_pays = mysqli_fetch_assoc($rs)){
            if($data_pays['id'] == $data['fk_pays']) {
                $html .= '                        <option value="' . $data_pays['id'] . '" selected>' . $data_pays['nom'] . '</option>';
            }else{
                $html .= '                        <option value="' . $data_pays['id'] . '">' . $data_pays['nom'] . '</option>';
            }
        }
    }
    $html.= '                   </select>';
    $html.= '               </label>';
    $html.= '           </div>';
    $html.= '           <div style="clear:both;"></div>';

    // Gestion Avatar
    $html.= '           <div class="section"><span>4</span>Avatar</div>';
    $html.= '           <div class="inner-wrap-l">';
    $html.= '               <label>Avatar <input type="file" name="form_avatar" /></label>';
    $html.= '           </div>';
    $html.= '           <div class="inner-wrap-r">';
    $html.= '           </div>';
    $html.= '           <div style="clear:both;"></div>';

    // Ajout champs caché
    $html.= '           <input type="hidden" name="id_user" value="'.$id_user.'" />';

    // Bouton Enregistrer
    $html.= '           <div class="button-section">';
    $html.= '               <input type="submit" name="Enregistrer" />';
    $html.= '           </div>';

    $html.= '       </form>';
    $html.= '   </div>';
    $html.= '</div>';
?>