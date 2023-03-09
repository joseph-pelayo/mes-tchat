<?php

// Récupération des messages et pièces jointe associés

    $title_page = "Chat";
    $html ="";
    
    $datas = [] ;
    $sql = "SELECT * FROM message;";
    $res = query($sql);
    
    if($res && mysqli_num_rows($res)){
        
        while($data = mysqli_fetch_assoc($res)){
            $message= array('id' =>$data['id'], 'text' =>  $data['message'], 'date'=> $data['date']);
            // $message['id'] = $data['id'];
            // $message['text'] = $data['message'];
            // $message['date'] = $data['date'];
            $user_id = $data['user_id'];
            $message_id = $data['id'];
        }

        $sql = "SELECT login FROM t_user WHERE id =".$user_id;
        $user = squery($sql);

        $sql = "SELECT  p.id, 
                        p.data AS data, 
                        t.libelle as type
                from piece as p
                LEFT JOIN type_piece as t ON p.type_id = t.id
                WHERE message_id=". $message_id ;
        $res = query($sql);
        $pieces=[];
        if($res && mysqli_num_rows($res)){
            
            while($data_piece = mysqli_fetch_assoc($res)){
                $pieces[]= array('id'=>$data_piece['id'], 'data' => $data_piece['data'],'type' =>$data_piece['type'] );
            }

        }
        $datas[] = array('user' => $user, 'message' => $message, 'pieces'=> $pieces);
    }

    // var_dump($datas);
    // $html.= '<p>'.$datas[0]['user'].'</p>'.PHP_EOL;
    // // echo($datas[0]['message']).PHP_EOL;  // 
    // $html.= '<p>'.$datas[0]['message']['id'].'</p>'.PHP_EOL; // 
    // $html.= '<p>'.$datas[0]['message']['text'].'</p>'.PHP_EOL; // 
    // $html.= '<p>'.$datas[0]['message']['date'].'</p>'.PHP_EOL; // 
    // // echo ($datas[0]['pieces']).PHP_EOL; // liste pièce jointe
    // $html.= '<p>'.$datas[0]['pieces'][0]['data'].'</p>'.PHP_EOL; 
    // $html.= '<p>'.$datas[0]['pieces'][0]['type'].'</p>'.PHP_EOL;


    
    $html.= '<div class="zone_display_tchat">';

        $html.= '<h1 class="main_title">Tchat</h1>';


        $html.= '<section class="msger">';
        $html.= '  <header class="msger-header">';
        $html.= '      <div class="msger-header-title">';
        $html.= '          <i class="fas fa-comment-alt"></i>Tchachachat';
        $html.= '      </div>';
        $html.= '      <div class="msger-header-options">';
        $html.= '          <span><i class="fas fa-cog"></i></span>';
        $html.= '      </div>';
        $html.= '  </header>';


                    // var_dump($datas);
    // $html.= '<p>'.$datas[0]['user'].'</p>'.PHP_EOL;
    // // echo($datas[0]['message']).PHP_EOL;  // 
    // $html.= '<p>'.$datas[0]['message']['id'].'</p>'.PHP_EOL; // 
    // $html.= '<p>'.$datas[0]['message']['text'].'</p>'.PHP_EOL; // 
    // $html.= '<p>'.$datas[0]['message']['date'].'</p>'.PHP_EOL; // 
    // // echo ($datas[0]['pieces']).PHP_EOL; // liste pièce jointe
    // $html.= '<p>'.$datas[0]['pieces'][0]['data'].'</p>'.PHP_EOL; 
    // $html.= '<p>'.$datas[0]['pieces'][0]['type'].'</p>'.PHP_EOL;







        
        $html.= '  <main id="msger-chat" class="msger-chat">';

        foreach($datas as $data) {

            $sql = "SELECT id from t_user where username = '" . $data['user'] . "';";
            
            $id_user = squery($sql);

            // Test parité
            if (( $id_user % 2) == 0) { // Nombre pair

                $class_msg = "left-msg";
                $image_url = ''https://image.flaticon.com/icons/svg/167/167750.svg' : 'https://image.flaticon.com/icons/svg/189/189061.svg';

            } else {

                $class_msg = "right-msg";

            }

            $html .= '<div class="msg '.$class_msg.'">';
            $html .= '<div class="msg-img" style="background-image: url('.$image_url.')"></div>';
            $html .= '<div class="msg-bubble">';
            $html .= '<div class="msg-info">';
            $html .= '<div class="msg-info-name">'.$data['user'].'</div>';
            $html .= '<div class="msg-info-time">'.$data['message']['date'].'</div>';
            $html .= '</div>';
            $html .= '<div class="msg-text">';
            $html .= $data['message']['text'];
            $html .= '</div>';



        }

        $html.= '      <div class="msg left-msg">';
        $html.= '          <div class="msg-img" style="background-image: url(https://image.flaticon.com/icons/svg/167/167750.svg)"></div>';
        $html.= '              <div class="msg-bubble">';
        $html.= '                  <div class="msg-info">';
        $html.= '                      <div class="msg-info-name">'.$datas[0]['user'].'</div>';
        $html .= '                      <div class="msg-info-time">12:45</div>';
        $html .= '                  </div>';
        $html .= '              <div class="msg-text">';
        $html .= '                  Salut, comment tu vas ? <h1 id="resultat"></h1>';
        $html .= '              </div>';
        $html .= '          </div>';
        $html .= '      </div>';
       




        $html .= '      <div class="msg right-msg">';
        $html .= '          <div class="msg-img" style="background-image: url(https://image.flaticon.com/icons/svg/189/189061.svg)"></div>';
        $html .= '              <div class="msg-bubble">';
        $html .= '                  <div class="msg-info">';
        $html .= '                      <div class="msg-info-name">Pierre</div>';
        $html .= '                          <div class="msg-info-time">12:46</div>';
        $html .= '                      </div>';
        $html .= '                  <div class="msg-text">Très bien et toi ?</div>';
        $html .= '              </div>';
        $html .= '     </div>';
        
        $html .= '<div class="msg left-msg">';
        $html .= '<div class="msg-img" style="background-image: url(https://image.flaticon.com/icons/svg/167/167750.svg)"></div>';
        $html .= '<div class="msg-bubble">';
        $html .= '<div class="msg-info">';
        $html .= '<div class="msg-info-name">TOM</div>';
        $html .= '<div class="msg-info-time">12:47</div>';
        $html .= '</div>';
        $html .= '<div class="msg-text">';
        $html .= 'Je vais bien, je voulais savoir si tu avais bien reçu le projet par email ?';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</main>';
        
        $html .= '<form class="msger-inputarea">';
        $html .= '<input type="text" class="msger-input" name="input-msg" placeholder="Ecrivez votre message ..">';
        $html .= '<button type="submit" class="msger-send-btn">Envoyer</button>';
        $html .= '</form>';
        
        $html .= '</section>';



    $html.= '</div>';


















    // Liste des utilisateurs connectés

    



?>

