<?php

class Page {
   public function get_body($name_template,$tbl){
    ob_start();
    include $name_template.".php";
    return ob_get_clean();
   } 
   
    
}


?>