<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class BandMemberController extends AppController {

    var $name = "BandMember";
    var $helpers = array('Html', 'Form', 'Js');
    var $components = array('RequestHandler', 'Email');

    function addMember() {

        $this->set('band', $this->Session->read('band'));
        
        $bandMember = $this->BandMember->create();
        $bandMember['BandMember']['band_id'] = $this->data['BandMember']['band_id'];
        $bandMember['BandMember']['user_id'] = $this->data['BandMember']['user_id'];
        $bandMember['BandMember']['role'] = $this->data['BandMember']['role'];
        
        if ($this->data['BandMember']['user_id'] == "") {
            $this->loadModel("User");
            $user = $this->User->create();
            $user['User']['first_name'] = $this->data['User']['first_name'];
            $user['User']['last_name'] = $this->data['User']['last_name'];
            $user['User']['username'] = $this->data['User']['username'];
            $user['User']['password'] = 'test';
            $user['User']['role'] = 'band';
            $user['User']['status'] = 2;

            $token = substr(md5(uniqid(rand(), 1)), 0, 10);
            $user['User']['verificationCode'] = $token;
            $user = $this->User->save($user);

            if ($user) {
	                        $user['User']['status'] = 1;
                $this->set('resetUser', $user);
                $this->Email->to = $this->data['User']['username'];;
                $this->Email->subject = 'Bluecaffeine.com New User';
                $this->Email->smtpOptions = Configure::read('emailOptions');
                $this->Email->delivery = 'smtp';
                $this->Email->template = 'reset_password';
                $this->Email->sendAs = 'html';
                $this->Email->from = 'rilangotest@gmail.com';
                $this->Email->send();

                $bandMember['BandMember']['user_id'] =  $user['User']['id'];
            }
        }
        if ($this->BandMember->save($bandMember)) {
            $this->loadModel('Band');
            $this->Band->recursive = 1;
            $this->set('band', $this->Band->findById($this->data['BandMember']['band_id']));
            $this->render('memberlist', 'ajax');
        } else {
            $this->render('addMember', 'ajax');
        }
    }

    function deleteMember($userId = null, $bandId = null) {

        $this->BandMember->query('delete from band_members where user_id='
            . $userId . ' and band_id=' . $bandId);
        $this->loadModel('Band');
        $this->Band->recursive = 1;
        $this->set('band', $this->Band->findById($bandId));
        $this->render('memberlist', 'ajax');
    }

    function memberEmail($enteredValue) {
        $this->loadModel('User');
        $userList = $this->User->find('all', array(
            'conditions' => array(
                'User.username LIKE' => $enteredValue . '%'
            ),
            'fields' => array('username', 'first_name', 'last_name', 'id'),
            'limit' => 3,
            'recursive' => -1,
            ));
        //$userList = Set::Extract($userList, '{n}.User.username');
        $this->set('userList', $userList);
        $this->layout = 'ajax';
    }

}

?>
