<?php
// Ajout d'un message
include '../../inc/sql_connect.php';
// Verifier si on a cliqué sur le bouton envoyer
if(isset($_POST) && !empty($_POST)){
    // L'utilisateur a cliqué sur envoyer => Analyser le retour
    $h_message = array();
    $h_message['message'] = $_POST['form_msg'];
    $date = new DateTime();
    $h_message['date'] = $date->format('Y-m-d H:i:s');
    // echo $date->format('Y-m-d H:i:s');
    // exit();
    $h_message['user_id'] = $_SESSION[SITE_NAME]['id_user'];
    // $h_message['user_id'] = 5;

    // Ajout du message dans la base de donnée
    $id_message = sql_simple_insert('message',$h_message);

    $res = query('SELECT * FROM type_piece' );
    if($res && mysqli_num_rows($res)){
        $type_pieces = array();
        while($data = mysqli_fetch_assoc($res)){
            $type_pieces[] = $data;
        }

    }
    // Gestion de l'upload s'il y a un fichier
    if(isset($_FILES) && !empty($_FILES) && !empty($_FILES['piece']['name'])){
        // L'utilisateur a voulu uploader un fichier
        $files = array_filter($_FILES['piece']['name']);
        $total = count($_FILES['piece']['name']);
        $files = array();
        $upload_dir = '../../pieces/';
        $formats = array('pdf','docx','mp4','jpg','png','gif');
        if($total > 0){
            for($i = 0; $i< $total; $i++){
                
                $tab_name = explode('.', $_FILES['piece']['name'][$i]);
                $ext = $tab_name[count($tab_name)-1];
                // echo $ext;
                // exit();
                $unique_name = uniqid('file_').'.'.$ext;
        
                if(!in_array(strtolower($ext),$formats)) {
                    echo 'error';
                    exit();
                }
                $upload_file = $upload_dir.$unique_name;
        
                // Upload réel
                move_uploaded_file($_FILES['piece']['tmp_name'][$i], $upload_file);
                $h_piece = array();
                $h_piece['message_id'] = $id_message;
                if($ext == 'pdf' || $ext=="docx")
                    $h_piece['type_id'] = 1;
                if($ext == 'mp4')
                    $h_piece['type_id'] = 4;
                if($ext == 'jpg' || $ext == 'png' || $ext == 'gif')
                    $h_piece['type_id'] = 2;
                
                $h_piece['data'] = $unique_name;

                sql_simple_insert('piece',$h_piece);
                
            }
        }
    // }
}
else{
    
}
    $html='';
    $html .= '      <div class="msg right-msg">';
    $html .= '          <div class="msg-img" style="background-image: url(https://image.flaticon.com/icons/svg/189/189061.svg)%22%3E</div>';
    $html .= '              <div class="msg-bubble">';
    $html .= '                  <div class="msg-info">';
    $html .= '                      <div class="msg-info-name">'.$_SESSION[SITE_NAME]['nom_user'].'</div>';
    $html .= '                          <div class="msg-info-time">'.$date->format('H:i').'</div>';
    $html .= '                      </div>';
    $html .= '                  <div class="msg-text">'.$h_message['message'].'</div>';
    $html .= '              </div>';
    $html .= '     </div>';

    echo $html;
}

?>