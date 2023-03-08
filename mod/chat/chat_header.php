<?php

// Ajout d'un message
// Verifier si on a cliqué sur le bouton envoyer
if(isset($_POST) && !empty($_POST)){
    // L'utilisateur a cliqué sur envoyer => Analyser le retour
    $h_message = array();
    $h_message['message'] = $_POST['form_nom'];
    $h_message['date'] = date("Y-m-d H:i:s");
    $h_message['user_id'] = $_SESSION[SITE_NAME]['id_user'];
    if(!empty($_POST['form_password']))
        $h['password'] = md5($_POST['form_password']);
    $h['adresse'] = $_POST['form_adresse'];
    $h['code_postal'] = $_POST['form_cp'];
    $h['fk_ville'] = $_POST['form_ville'];
    $h['fk_pays'] = $_POST['form_pays'];

}
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
    // $html.= '<p>'.$datas[0]['user'].'</p>'.PHP_EOL; // 
    // echo($datas[0]['message']).PHP_EOL;  // 
    // $html.= '<p>'.$datas[0]['message']['id'].'</p>'.PHP_EOL; // 
    // $html.= '<p>'.$datas[0]['message']['text'].'</p>'.PHP_EOL; // 
    // $html.= '<p>'.$datas[0]['message']['date'].'</p>'.PHP_EOL; // 
    // echo ($datas[0]['pieces']).PHP_EOL; // liste pièce jointe
    // $html.= '<p>'.$datas[0]['pieces'][0]['data'].'</p>'.PHP_EOL; 
    // $html.= '<p>'.$datas[0]['pieces'][0]['type'].'</p>'.PHP_EOL; 
?>