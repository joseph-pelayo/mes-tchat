<?php

//error_reporting(E_ALL);
//ini_set("display_errors", 1);
class Page
{
    private $header = '';
    private $footer = '';
    private $corps  = '';


    // Constructeur
    public function __construct($show_interface = true, $title = '', $link = array())
    {
        if ($show_interface) {
            $this->build_header($title, $link);
            $this->build_footer();
        } else {
            $this->header = '<body>';
            $this->footer = '</body>';
        }
    }

    private function build_header($title, $link)
    {
        $this->header = '<body>';
        $this->header .= '   <div class="header">';
        $this->header .= '       <a href="index.php?page=home">Accueil</a>';
        $this->header .= '       <a href="index.php?page=galerie">Galerie</a>';
        $this->header .= '       <a href="index.php?page=mosaic">Mosaic</a>';
        $this->header .= '   </div>';


        $this->header .= '    <div class="header_top">';
        $this->header .= '       <div class="header_login">';
        $this->header .= '           <div class="header_logout_btn">';
        $this->header .= '               <a href="index.php?page=logout">';
        $this->header .= '                   <img src="pic/interface/logout.png" />';
        $this->header .= '               </a>';
        $this->header .= '            </div>';
        $this->header .= '            <div class="header_info_user">';

        $avatar = "pic/interface/user_default.png";

        $sql = "SELECT avatar FROM t_user WHERE id=" . $_SESSION[SITE_NAME]['id_user'];
        $rs = query($sql);

        if ($rs && mysqli_num_rows($rs)) {
            $data = mysqli_fetch_assoc($rs);
            $avatar = "pic/avatar/" . $data['avatar'];
        }
        // Ajouter le statut en ligne
        $status = ($_SESSION[SITE_NAME]['is_connected']) ? 'En ligne' : 'Hors ligne';


        $this->header .= '              <div class="header_user_details">';
        $this->header .= '                  <img src="' . $avatar . '" />';
        $this->header .= '                  <span class="header_user_name">' . $_SESSION[SITE_NAME]['nom_user'] . '</span>';
        $this->header .= '                  <span class="status">' . $status . '</span>';
        $this->header .= '              </div>';
        $this->header .= '            </div>';
        $this->header .= '       </div>';

        $this->header .= '       <div class="header_link">';
        foreach ($link as $data_link) {
            $this->header .= '           <div class="one_link">';
            $this->header .= '               <a href="' . $data_link['url'] . '">';
            $this->header .= '                   <img src="pic/interface/' . $data_link['image'] . '" /><br/>' . $data_link['text'];
            $this->header .= '               </a>';
            $this->header .= '           </div>';
        }
        $this->header .= '       </div>';
        $this->header .= '    </div>';
        $this->header .= '    <div class="content">';
    }


    private function build_footer()
    {
        $this->footer = '   </div>'; // Fermeture de la balise Content
        $this->footer .= '</body>';
    }

    public function build_content($html = '')
    {
        $this->corps = $html;
    }

    public function show()
    {
        echo $this->header;
        echo $this->corps;
        echo $this->footer;
    }
}
