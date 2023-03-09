<?php
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
        $this->header .= '    <div class="menu">';
        $this->header .= '       <img src="pic/interface/logo_site.png" class="logo_site"/><br/>';
        $this->header .= '       <a href="index.php">';
        $this->header .= '          <img src="pic/interface/home.png" /><br/>Accueil';
        $this->header .= '      </a>';
        $this->header .= '       <a href="index.php?page=listing_salon">';
        $this->header .= '           <img src="pic/interface/salon.png" /><br/>Salon';
        $this->header .= '       </a>';
        $this->header .= '       <a href="index.php?page=galerie">';
        $this->header .= '           <img src="pic/interface/galerie.png" /><br/>Galerie';
        $this->header .= '       </a>';
        $this->header .= '       <a href="index.php?page=import">';
        $this->header .= '           <img src="pic/interface/import.png" /><br/>Import';
        $this->header .= '       </a>';
        $this->header .= '       <a href="index.php?page=listing_user">';
        $this->header .= '           <img src="pic/interface/user.png" /><br/>listing Users';
        $this->header .= '       </a>';
        $this->header .= '      <a href="index.php?page=listing_ville">';
        $this->header .= '           <img src="pic/interface/ville.png" /><br/>Listing Ville';
        $this->header .= '      </a>';
        $this->header .= '       <a href="index.php?page=listing_pays">';
        $this->header .= '           <img src="pic/interface/pays.png" /><br/>Listing Pays';
        $this->header .= '       </a>';
        $this->header .= '       <a href="index.php?page=param">';
        $this->header .= '           <img src="pic/interface/param.png" /><br/>Parametres';
        $this->header .= '       </a>';
        $this->header .= '    </div>';

        $this->header .= '    <div class="header_top">';
        $this->header .= '       <div class="header_login">';
        $this->header .= '           <div class="header_logout_btn">';
        $this->header .= '               <a href="index.php?page=logout">';
        $this->header .= '                   <img src="pic/interface/logout.png" />';
        $this->header .= '               </a>';
        $this->header .= '            </div>';
        $this->header .= '            <div class="header_info_user">';

        $this->header .= $_SESSION[SITE_NAME]['nom_user'];

        $avatar = "pic/interface/user_default.png";

        $sql = "SELECT avatar FROM t_user WHERE id=" . $_SESSION[SITE_NAME]['id_user'];
        $rs = query($sql);
        if ($rs && mysqli_num_rows($rs)) {
            $data = mysqli_fetch_assoc($rs);
            $avatar = "pic/avatar/" . $data['avatar'];
        }

        $this->header .= '              <img src="' . $avatar . '" />';
        $this->header .= '            </div>';
        $this->header .= '       </div>';
        $this->header .= '      <div class="header_title">';

        if (isset($title) && !empty($title)) {
            $this->header .= $title;
        }

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
