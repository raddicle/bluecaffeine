<?php

//App::import('Vendor', 'facebook/facebook');

class UsersController extends AppController {

    var $name = 'Users';
    var $helpers = array('Html', 'Form', 'Session', 'Facebook.Facebook');
    var $components = array('Session', 'Auth', 'Facebook.Connect', 'Email');

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('forgot', 'emailPasswdLink', 'activate', 'resetPasswd', 'emailverification');
    }

    function login() {

        $this->autoRender = false;
        if (!empty($this->data)) {

            $username = $this->Auth->data['User']['username'];
            $find_by_email = $this->User->find('first', array(
                'conditions' => array('username' => $this->data['User']['username'])
                    )
            );

            if ($find_by_email['User']['status'] != 0) {

                $response = $this->User->create();
                $response['User']['returnCode'] = '1';
                $response['User']['errorMsg'] = 'Account is inactive. This  may be because you requested reset password.';
                return json_encode($response);
            } else if (!empty($find_by_email)
                    && $find_by_email['User']['password'] == $this->data['User']['password']) {

                $this->Auth->login($this->data);
                $this->Session->write('user', $find_by_email);

                $response = $this->User->create();
                $response['User']['returnCode'] = '0';
                return json_encode($response);
            } else {

                $this->Session->setFlash('Incorrect User/Password.');
                $response = $this->User->create();
                $response['User']['returnCode'] = '1';
                $response['User']['errorMsg'] = 'Incorrect User/Password.';
                return json_encode($response);
            }
        } else {
            $facebookUser = $this->Connect->user();

            if (!empty($facebookUser)) {

                $existUser = $this->User->find('first', array(
                    'conditions' => array('username' => $facebookUser['email'])
                        )
                );
                if (empty($existUser)) {
                    $userDetails = $this->User->create();
                    $userDetails['User']['first_name'] = $facebookUser['first_name'];
                    $userDetails['User']['last_name'] = $facebookUser['last_name'];
                    $userDetails['User']['username'] = $facebookUser['email'];
                    $userDetails['User']['password'] = 'test';
                    $userDetails['User']['fbid'] = $facebookUser['id'];
                    $userDetails['User']['role'] = 'fan';
                    $userDetails = $this->User->save($userDetails);
                }

                $this->Session->write('facebookUser', $facebookUser);
                $this->Session->write('user', $existUser);

                $this->Auth->login($existUser);
                $response = $this->User->create();
                $response['User']['returnCode'] = '0';
                $this->render("/Pages/home");
            }
        }
    }

    function emailPasswdLink() {
        if (!empty($this->data)) {
            if ($this->data['User']['username'] != '') {
                $existUser = $this->User->find('first', array(
                    'conditions' => array('username' => $this->data['User']['username'])
                        ));
                if ($existUser) {

                    $token = substr(md5(uniqid(rand(), 1)), 0, 10);
                    $existUser['User']['verificationCode'] = $token;
                    $existUser['User']['status'] = 1;

                    if ($this->User->save($existUser)) {
                        $this->set('resetUser', $existUser);

                        $this->Email->to = $existUser['User']['username'];
                        $this->Email->subject = 'Bluecaffeine.com Reset Password';
                        $this->Email->smtpOptions = Configure::read('emailOptions');
                        $this->Email->delivery = 'smtp';
                        $this->Email->template = 'reset_password';
                        $this->Email->sendAs = 'html';
                        $this->Email->from = 'rilangotest@gmail.com';
                        $this->Email->send();

                        $this->set('passwdResetRequestStatus', 'An email is send to your email account. Please the url send in the mail to reset the password.');
                    } else {
                        $this->set('passwdResetRequestStatus', 'An error occured while resetting the password. Please contact the web master.');
                    }
                } else {
                    $this->set('passwdResetRequestStatus', 'User Name not found.');
                    $this->render('forgot');
                }
            } else {
                $this->set('passwdResetRequestStatus', 'Please enter your username.');
                $this->render('forgot');
            }
        }
    }

    function activate($id, $token) {

        if (empty($id) || empty($token)) {
            $this->set('resetPasswdStatus', 'Invalid Account activation url.');
        } else {

            $existUser = $this->User->find('first', array(
                'conditions' => array('verificationCode' => $token
                    , 'id' => $id)
                    ));
            if (empty($existUser)) {
                $this->set('resetPasswdStatus', 'Invalid Account activation url.');
            } else {
                $this->set('passwdresetUser', $existUser);
            }
        }
    }

    function resetPasswd() {
        if (!empty($this->data)) {
            if ($this->data['User']['password'] == $this->data['User']['confirm_password'] && $this->data['User']['password'] != "") {
                $userDetails = $this->User->create();
                $userDetails['User']['id'] = $this->data['User']['id'];
                $userDetails['User']['password'] = $this->data['User']['password'];
                $userDetails['User']['verificationCode'] = '';
                $userDetails['User']['status'] = 0;
                $this->User->save($userDetails);
            } else {
                $this->set('resetPasswdStatus', 'Please enter Password and Confirm Password. Both Values should be same.');
                $this->set('passwdresetUser', $this->data);
                $this->render('activate');
            }
        }
    }

    function logout() {

        $test = $this->Auth->logout();
        $this->Session->destroy();
        $this->render("/Pages/home");
    }

    function register() {
        if (!empty($this->data)) {
            if ($this->data['User']['password'] == $this->data['User']['confirm_password']) {

                $userDetails = $this->User->create();
                $userDetails['User']['first_name'] = $this->data['User']['first_name'];
                $userDetails['User']['last_name'] = $this->data['User']['last_name'];
                $userDetails['User']['username'] = $this->data['User']['username'];
                $userDetails['User']['password'] = $this->data['User']['password'];
                $userDetails['User']['role'] = 'fan';
                $userDetails['User']['status'] = '1';
                $userDetails['User']['verificationCode'] = substr(md5(uniqid(rand(), 1)), 0, 10);

                $userDetails = $this->User->save($userDetails);

                if ($userDetails) {

                    $this->Session->write('user', $userDetails);
                    $this->set('newUser', $userDetails);
                    $this->Email->to = $userDetails['User']['username'];
                    $this->Email->subject = 'Bluecaffeine.com New User';
                    $this->Email->smtpOptions = Configure::read('emailOptions');
                    $this->Email->delivery = 'smtp';
                    $this->Email->template = 'email_verification';
                    $this->Email->sendAs = 'html';
                    $this->Email->from = 'rilangotest@gmail.com';
                    $this->Email->send();
                    return $this->render('registered', 'ajax');
                }
            }
        }
        return $this->render('register', 'ajax');
    }

    function emailverification($id, $token) {
        if (empty($id) || empty($token)) {
            $this->set('emailverificationStatus', 'Invalid Account activation url.');
        } else {

            $existUser = $this->User->find('first', array(
                'conditions' => array('verificationCode' => $token
                    , 'id' => $id)
                    ));
            if (empty($existUser)) {
                $this->set('emailverificationStatus', 'Invalid Account activation url.');
            } else {
                $userDetails['User']['status'] = '0';
                $userDetails['User']['verificationCode'] = '';
                $this->User->save($userDetails);
                $this->Auth->login($userDetails);
                
                return $this->redirect('/');
            }
        }
    }

    function users() {
        
    }

    function forgot() {
        
    }
}
?>
