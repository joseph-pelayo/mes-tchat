<?php
    $DATABASE = 'cdui_0323';
    $SERVEUR = '192.168.56.3'; // 127.0.0.1
    $USER = 'root';
    $PASS = 'root';             // A mettre a jours sur vos postes !

    // Message d'erreur
    $die_message_serveur = 'Connexion impossible au serveur';
    $die_message_bdd = 'Connexion impossible à la BDD';

    // Connexion au serveur
    $link = ($GLOBALS["___mysqli_ston"] = mysqli_connect($SERVEUR,  $USER,  $PASS)) or die($die_message_serveur);

    // Selection de la BDD
    mysqli_select_db($link, $DATABASE) or die($die_message_bdd);

    // Pour en finir avec les soucis d'accent non gérés.
    $sql="SET CHARACTER SET 'utf8mb4';";
    mysqli_query($link, $sql);

    $sql="SET collation_connection = 'utf8mb4_general_ci';";
    mysqli_query($link, $sql);



    // Fonction MySQL
    function query($sql=""){
        if(!$sql) return false;
        $rs = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
        return $rs;
    }

    function squery($sql){
        $result=query($sql);
        if(@mysqli_num_rows($result)==1){
            $r=@mysqli_fetch_row($result);
            return $r[0];
        }
        if(@mysqli_num_rows($result)>1){
            $r=array();
            while($row=@mysqli_fetch_assoc($result)) $r[]=$row;
            return $r;
        }
        return FALSE;
    }

    function sql_simple_insert($table,$r,$transaction_mode=FALSE){
        foreach($r as $key => $val){
            $insert[]='`'.$key.'`';
            $value[]="'".addslashes($val)."'";
        }
        $sql="INSERT INTO ".$table." (".implode(', ',$insert).") VALUES (".implode(', ',$value).");";
        if($transaction_mode){
            return $sql;
        }else{
            query($sql);
            return @((is_null($___mysqli_res = mysqli_insert_id($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);
        }
    }

    function sql_simple_update($table,$id,$r,$transaction_mode=FALSE,$id_name='id'){
        foreach($r as $key => $value)$tmp_set[]=$key."='".addslashes($value)."'";

        $sql="UPDATE ".$table." SET ".implode(', ',$tmp_set)." WHERE $id_name='".$id."' LIMIT 1;";
        if($transaction_mode)
            return $sql;
        else
            return query($sql);
    }

    function sql_simple_delete($table,$id,$transaction_mode=FALSE){
        $sql="DELETE FROM ".$table." WHERE id='".$id."' LIMIT 1;";
        if($transaction_mode)
            return $sql;
        else
            return query($sql);
    }

    function build_r_from_id($table, $id){
        $sql="SELECT * FROM ".$table." WHERE `id` ='".$id."' LIMIT 1";
        $result=query($sql);
        return mysqli_fetch_assoc($result);
    }

?>