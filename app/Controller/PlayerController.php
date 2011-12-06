<?php

class PlayerController extends AppController {
    
    var $name = "Player";
    
    
    function view() {
        
        $this->render('player', 'ajax');
    }
}
?>
