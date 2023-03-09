<?php
// Verifier si on a cliqué sur le bouton envoyer
if (isset($_POST) && !empty($_POST)) {
    // L'utilisateur a cliqué sur envoyer => Analyser le retour
    $h = array();
    $h['name'] = $_POST['name_salon'];

    $id_salon = $_POST['id_salon'];
    if ($id_salon) {
        sql_simple_update('salon', $id_salon, $h);
    } else {
        sql_simple_insert('salon', $h);
    }
    header('location: index.php?page=listing_salon');
}

// Une verification si Ajout ou Modification d'un enregistrement
if (isset($_GET['id'])) {
    // Je suis en modification
    $id_salon = $_GET['id'];
    $data = build_r_from_id('salon', $id_salon);
    $title_page = 'Modification du salon';
} else {
    // Je suis en Ajout
    $id_salon = 0;
    $data = array();
    $data['name'] = '';
    $title_page = 'Ajout d\'un Salon';
}


// Generation du formulaire en HTML
$html = '<div class="zone_contenu_clean"><br/><br/>';
$html .= '    <div class="form-style">';

if ($id_salon) {
    $html .= '        <h1>Modification Salon<span>Pour modifier un salon, remplir ce formulaire...</span></h1>';
} else {
    $html .= '        <h1>Nouveau salon<span>Pour créer un salon, remplir ce formulaire...</span></h1>';
}

// Debut du Formulaire HTML
$html .= '        <form action="index.php?page=add_salon" method="post" enctype="multipart/form-data">';
$html .= '           <div class="section"><span>1</span>Nom du salon</div>';
$html .= '           <div class="inner-wrap">';

// Input type text pour le nom
$html .= '               <label>Nom <input type="text" name="name_salon" value="' . $data['name'] . '"/></label>';
$html .= '           </div>';
$html .= '           <div style="clear:both;"></div>';
$html .= '               </label>';

// Ajout champs caché
$html .= '           <input type="hidden" name="id_salon" value="' . $id_salon . '">';

// Bouton Enregistrer
$html .= '           <div class="button-section">';
$html .= '               <input type="submit" name="Enregistrer" />';
$html .= '           </div>';

$html .= '       </form>';
$html .= '   </div>';
$html .= '</div>';
