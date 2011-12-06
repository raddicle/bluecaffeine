<?php
class PostsController extends AppController {

  var $name = 'Posts';
  var $helpers = array('Html', 'Form', 'Js');
  var $components = array('RequestHandler');


  function view($id = null) {
    
      $this->Post->recursive = 0;
      $this->set('post', $this->Post->findById($id));
      $this->render('edit', 'ajax');      

  }
  
  function delete($id) {

    $this->Post->delete($id);

    $this->loadModel('Band');
    $this->Band->recursive = 1;
    $this->Session->read("bandId");
    $test = $this->Band->findById($this->Session->read("bandId"));
    $this->set('band', $this->Band->findById($this->Session->read("bandId")));
    $this->render('list', 'ajax');
  }


  function post() {

      $this->loadModel('Post');
      if ($this->Post->save($this->data)) {
        $this->Session->setFlash('Your post has been updated.');
      } else {
          $this->Session->setFlash('An unexpected error occured while creating the blog.');
      }
        $this->loadModel('Band');
        $this->Band->recursive = 1;
        $this->Session->read("bandId");
        //$test = $this->Band->findById($this->Session->read("bandId"));
        $this->set('band', $this->Band->findById($this->Session->read("bandId")));
        $this->render('list', 'ajax');
  }

}
?>
