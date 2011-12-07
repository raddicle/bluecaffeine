<?php

class BandNewsController extends AppController {

    var $name = 'BandNews';
    var $helpers = array('Html', 'Form', 'Js');
    var $components = array('RequestHandler');

    function fetchNewsFromurl(){

      $this->autoRender = false;
      if (!empty($this->data)){

        $titleFound = false;
        $bandNews = $this->BandNews->create();

        $newsURL = $this->data['newsurl'];

        $pageContent = file_get_contents($newsURL);
        $titles = array();
        $pattern = '|<title>(.*?)</title>|si';
        
        preg_match_all($pattern, $pageContent, $titles);
        
        foreach ($titles as $title) {
          foreach ($title as $match) {
            $match = strip_tags($match);
            //$match = str_replace('<title>', '', $match);
            //$match = str_replace('</title>', '', $match);
            $bandNews['BandNews']['title'] = $match;
            $titleFound = true;
            break 2;
          }
        }
        
        $tags = get_meta_tags($newsURL);
        
        if (array_key_exists('description', $tags)) {
          $description = $tags['description'];
          $bandNews['BandNews']['description'] = $description;
        } else {
          $pattern = '|<p[^<][^a][^A][^r][^R]*?>(.*?)</p>|si';
          preg_match_all($pattern, $pageContent, $descriptions);
          foreach ($descriptions as $desc) {
            foreach ($desc as $description) {
              $description = strip_tags($description);
              $bandNews['BandNews']['description'] = $description;
              break 2;
            }
          }
        }

        if (!$titleFound && empty($description)) {
          $bandNews['BandNews']['returnCode'] = '1';
          $bandNews['BandNews']['errorMsg'] = 'Description not found.';

        }
      }

      return json_encode($bandNews);        
    }
    

    function view($id = null) {

        $this->BandNews->recursive = 0;
        $this->set('bandNews', $this->Post->findById($id));
        $this->render('edit', 'ajax');
    }

    function delete($id) {

        $this->BandNews->delete($id);
        $bandDetails = $this->Session->read('band');
        $this->loadModel('Band');
        $this->Band->recursive = 1;
        $this->Session->write('band', $this->Band->findById($bandDetails['Band']["id"]));
        $this->render('list', 'ajax');
    }

    function createBandNews() {

      $news = $this->BandNews->save($this->data);

      if ($news) {

        $bandDetails = $this->Session->read('band');
        $this->loadModel('Band');
        $this->Band->recursive = 1;
        $this->Session->write('band', $this->Band->findById($bandDetails['Band']["id"]));
        $this->Session->setFlash('Your News has been updated.');
      } else {
        $this->Session->setFlash('An unexpected error occured while creating the News.');
      }
      $this->render('list', 'ajax');
    }

}

?>
