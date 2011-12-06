<?php

class PrestartemailController extends AppController {
    
    
  var $name = 'Prestartemails';
  var $helpers = array('Html', 'Form', 'Js');
  var $components = array('RequestHandler');

  
    function acceptEmail(){
        
        $this->Prestartemail->save($this->data);
        $this->render("prestartemail");
    }
}
?>
