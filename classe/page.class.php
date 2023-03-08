<?php
    class Page{
        private $header = '';
        private $footer = '';
        private $corps  = '';


        // Constructeur
        public function __construct($show_interface=true, $title='', $link=array()){
            if($show_interface){
                $this->build_header($title,$link);
                $this->build_footer();
            } else {
                $this->header = '<body>';
                $this->footer = '</body>';
            }
        }

        private function build_header($title,$link){
            $this->header = '<body>';
            $this->header.= '   <div class="header">';
            $this->header.= '       <a href="index.php">Accueil</a>';
            $this->header.= '       <a href="index.php?page=galerie">Galerie</a>';
            $this->header.= '       <a href="index.php?page=mosaic">Mosaic</a>';
            $this->header.= '   </div>';
            $this->header.= '    <div class="content">';

        }

        private function build_footer(){
            $this->footer = '   </div>'; // Fermeture de la balise Content
            $this->footer.= '</body>';
        }

        public function build_content($html=''){
            $this->corps = $html;
        }

        public function show(){
            echo $this->header;
            echo $this->corps;
            echo $this->footer;
        }
    }

?>