<?php

    if(isset($_GET['import']) && !empty($_GET['import'])){
        $i = 0;
        $images = array();
        $folder = opendir('../import/');  // fr.php.net/opendir

        while(false !=($file = readdir($folder))){
            if($file != "." && $file != ".."){
                $images[$i]= $file;
                $i++;
            }
        }

        $j=0;
        foreach($images as $name_img){
            $j++;
            $importdir = '../import/';
            $importfile = $importdir . $name_img;

            $tab_name = explode('.',$name_img);
            $unique_name = uniqid('img_').'.'.$tab_name[count($tab_name) - 1];

            $myImg = new Image($importfile);
            $myImg->resizeByMin(64);
            $myImg->cropSquare();

            $myImg->store('../pic/upload/mosaic/'.$unique_name);
            $color = $myImg->average();

            unset($myImg);

            $h = array();
            $h['nom_fichier'] = $unique_name;
            $r = hexdec(substr($color,0,2));
            $g = hexdec(substr($color,2,2));
            $b = hexdec(substr($color,4,2));
            $h['r'] = $r;
            $h['g'] = $g;
            $h['b'] = $b;

            sql_simple_insert('t_mosaic', $h);

            @unlink($importfile);
        }
    }

    // Lecture des informations du repertoire import
    $i = 0;
    $images = array();
    $folder = opendir('../import/');

    while(false !=($file = readdir($folder))){
        if($file != "." && $file != ".."){
            $images[$i]= $file;
            $i++;
        }
    }

    // Compte nombre image deja en BDD
    $j = squery("SELECT COUNT(id) FROM t_mosaic");
    if(!$j) $j = 0;

    $html = '<div class="zone_titre_home" id="zone_titre_home">';
    $html.= '   Il y a actuellement '.$i.' images dans le répertoire d\'importation...<br/>';
    $html.= '   Il y a actuellement '.$j.' images dans la BDD<br/>';
    $html.= '   <br/><br/><br/>';
    $html.= '   <input type="button" onclick="location.href=\'index.php?page=import&import=1\';" value="Importer"/>';
    $html.= '</div>';

    // Gestion des liens dans le header
    $link = array(
        array(
            'image'=>'upload.png',
            'text'=>'Ajouter une <br/>Image',
            'url'=>'index.php?page=upload_mosaic',
        )
    );

?>