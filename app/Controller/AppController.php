<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {

    var $helpers = array('Html', 'Form', 'Session', 'Facebook.Facebook');
    var $components = array('Session', 'Auth', 'Facebook.Connect');

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login', 'logout', 'register', 'display', 'home', 'view', 'index');


        if (Configure::read('featuredBand') == '') {
            
            $featuredBandId = Configure::read('featuredBandId');
            $this->loadModel("Band");
            $bandDetails = $this->Band->findById($featuredBandId);
            Configure::write('featuredBand', $bandDetails);
        }
    }

}

?>