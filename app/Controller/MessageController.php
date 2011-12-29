<?php

class MessageController extends AppController {

    var $name = 'Message';
    var $components = array('Email', 'RequestHandler', 'Auth', 'Facebook.Connect');
    var $helpers = array('Html', 'Form', 'Facebook.Facebook', 'Js');

    function sendMsgToWebMaster() {

        $this->Message->create();
        if ($this->Message->save($this->data)) {

            $this->Email->from = $this->data['Message']['from'];
            $this->Email->to = $this->data['Message']['to'];
            $this->Email->subject = $this->data['Message']['subject'];
            //$this->Email->send($this->data['Message']['msg']);
            $this->autoRender = false;
            return json_encode('success');
        } else {
            $this->render('emailwebmaster', 'ajax');
        }
    }

}

?>