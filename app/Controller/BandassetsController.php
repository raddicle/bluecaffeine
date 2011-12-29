<?php

class BandassetsController extends AppController {

    var $name = "Bandassets";
    var $helpers = array('Html', 'Form', 'Js', 'fileupload', 'assetupload');
    var $components = array('RequestHandler');

    function view($mediaType = 1) {

        $this->loadModel('Band');
        $this->Band->recursive = 1;
        $this->set('band', $this->Band->findById($this->Session->read('bandId')));
        $this->set('mediaType', $mediaType);
        $this->render('list', 'ajax');
    }

    function uploadSong() {

        if (empty($this->data)) {
            $this->log('Asset could not be saved.', 'error');
            $this->set('uploadError', 'Unexpected error occured probabily because the uploaded file is too big.');
        } else {
            if ($this->data['Bandasset']['link'] == "" && $this->data['Bandasset']['image']["tmp_name"] == "") {
                $this->log('Asset could not be saved.', 'error');
                $this->set('uploadError', 'Unexpected error occured probabily because the uploaded file is too big.');
            } else {
                $value = $this->Bandasset->save($this->data);
                $this->set('mediaType', $value['Bandasset']['media_type']);
                if ($value) {
                    if ($this->data['Bandasset']['image']["tmp_name"] != "") {
                        $filename = $this->data['Bandasset']['image']['name'];
                        $fileExt = substr($filename, strrpos($filename, ".") + 1);

                        $target = WWW_ROOT . str_replace('/', DS, 'content/band/songs/song_'
                                . $value['Bandasset']['id'] . '.' . $fileExt);
                        move_uploaded_file($this->data['Bandasset']['image']["tmp_name"]
                            , $target);

                        
                        chmod($target, 0777);
                    }

                } else {
                    $this->log('Asset could not be saved.', 'error');
                }
            }
        }
        $this->render('uploadSong', 'ajax');
    }

    function delete($id = null, $mediaType = 1) {

        $this->Bandasset->delete($id);
        $this->loadModel('Band');
        $this->Band->recursive = 1;
        $this->set('band', $this->Band->findById($this->Session->read('bandId')));

        $this->set('mediaType', $mediaType);
        $this->render('list', 'ajax');
    }

}

?>