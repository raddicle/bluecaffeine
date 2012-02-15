<?php

class BandController extends AppController {

    var $name = "Bands";
    var $helpers = array('Html', 'Form', 'Js', 'Cropimage', 'fileupload'
        , 'assetupload', 'Cksource', 'AutoComplete');
    var $components = array('RequestHandler', 'JqImgcrop', 'Auth');

    /**
     * @param type $id 
     */
    function index($id = null) {

        $this->set('bands', $this->Band->find('all'));
    }

    /**
     * Retrieves Band data and sets it into band variable. This method only 
     * caters to AJAX calls.
     * 
     * @param type $id 
     */
    function manageBand($id = null) {

        $this->Band->recursive = 1;
        $bandDetails = $this->Band->findById($id);
        $this->set('band', $bandDetails );
        $this->Session->write('band', $bandDetails );
        $this->Session->write('bandId', $id);
        $this->referer('manageBand', 'ajax');
    }

    function view($id = null) {

        $this->Band->recursive = 1;
        $this->set('band', $this->Band->findById($id));
        $this->referer('profile');
    }

    function bandDetails($id = null) {
        $this->Band->recursive = 0;
        $this->set('band', $this->Band->findById($id));
        $this->render('bandDetails', 'ajax');
    }

    function showUploadForm() {
        if (!empty($this->data)) {
            $bandDetails = $this->Session->read('band');
            $uploaded = $this->JqImgcrop->uploadImage($this->data['Band']['image']
                , 'content/band/upload', 'band_' . $bandDetails['Band']['id']);
            $this->set('uploaded', $uploaded);
            $this->render('showUploadForm', 'ajax');
        }
    }
    
    function editProfileimage() {
        
        $this->render('editProfileimage', 'ajax');
        
    }


    function newBand(){

        if ($this->data) {
            $this->autoRender = false;
            $bandDetails = $this->Band->save($this->data);
                if ($bandDetails) {

                $this->loadModel("BandMember");
                $bandMember = $this->BandMember->create();
                $userDetails = $this->Session->read('user');

                $bandMember['BandMember']['band_id'] = $bandDetails['Band']['id'];
                $bandMember['BandMember']['user_id'] = $userDetails['User']['id'];
                $bandMember['BandMember']['role'] = 'Founder';
                $this->BandMember->save($bandMember);

                return json_encode($bandDetails['Band']['id']);
            } 
        } else {
            $this->render('newband', 'ajax');
        }
    }


    function save() {

        $this->Band->saveAll($this->data);
        $bandDetails = $this->Band->findById($this->data['Band']['id']);
        $this->set('band', $bandDetails );
        $this->Session->write('band', $bandDetails );

        $this->render('member', 'ajax');
    }

    /**
     * Crops the image to fit the users preference.
     */
    
    function cropImage() {

        $imageName = $this->data['Band']['imagePath'];
        $imageName = substr($imageName, strrpos($imageName, DS));

        $this->JqImgcrop->cropImage(400, $this->data['Band']['x1']
            , $this->data['Band']['y1'], $this->data['Band']['x2']
            , $this->data['Band']['y2'], $this->data['Band']['w']
            , $this->data['Band']['h'], 'content/band/thumbnail/' . $imageName
            , 'content/band/upload/' . $imageName);

        $this->set('uploadedImage', '/content/band/thumbnail/' . $imageName);
        $this->render('imageUpdated', 'ajax');
    }

}

?>