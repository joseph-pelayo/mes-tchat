<?php
    $maPage = new page(true, 'Importation en Masse', $link);

    $maPage->build_content($html);
    
    $maPage->show();
?>