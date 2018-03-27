<?php





class MYPDF extends Welcome {

        //Page header
        public function Header() {
                // Logo
                $image_file = K_PATH_IMAGES.'SA_flag.png';
                $this->Image($image_file, 90, 5, 40, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

                $style = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(39, 137, 199));

                $this->Line($this->getPageWidth()-PDF_MARGIN_RIGHT, 25, PDF_MARGIN_LEFT, 25, $style);


        }
}
?>