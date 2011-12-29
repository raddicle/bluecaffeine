<?php

class HomeController extends AppController {

    var $name = "Home";
    var $uses = array('Post', 'BandNews');
    var $helpers = array('Html', 'Form', 'Session', 'Js', 'Paginator');
    var $components = array('Session', 'Auth', 'RequestHandler', 'Paginator');

    function index() {

        $this->Paginator->settings = array('Post' => array(
                'fields' => array('Post.id', 'Post.title')
                , 'limit' => 2
                , 'order' => array('Post.id' => 'desc')
            ),
            'BandNews' => array(
                'fields' => array('BandNews.id', 'BandNews.title', 'BandNews.newsurl')
                , 'limit' => 5
                , 'order' => array('BandNews.id' => 'desc')
                ));
        $this->loadModel("Post");
        $this->loadModel("BandNews");

        $this->Post->recursive = -1;
        $this->BandNews->recursive = -1;
        $this->set('posts', $this->paginate('Post'));
        $this->set('news', $this->paginate('BandNews'));

        if ($this->RequestHandler->isAjax()) {
            $this->autoRender = false;
            return $this->render('index', 'ajax');
        }
    }

}

?>
