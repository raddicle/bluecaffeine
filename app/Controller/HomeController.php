<?php

class HomeController extends AppController {

    var $name = "Home";
    
    var $helpers = array('Html', 'Form', 'Session');
    var $components = array('Session', 'Auth');

    function index() {
        
    }

}

?>
