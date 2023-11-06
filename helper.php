<?php
class HelperFunction{
     function getHTMLView(){
        ob_start();
        include("./table.php");
        $view=ob_get_contents(); 
        ob_end_clean();
        return $view;
     }
}
?>
