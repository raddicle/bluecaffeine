<?php

class UsersController extends AppController {

    var $name = 'Users';
    var $helpers = array('Html', 'Form', 'Session', 'Facebook.Facebook', 'Js', 'Cropimage');
    var $components = array('Session', 'Auth', 'Facebook.Connect', 'Email', 'JqImgcrop');

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('forgot', 'emailPasswdLink', 'activate', 'resetPasswd', 'emailverification');
    }

    function login() {

        $this->autoRender = false;
        if (!empty($this->data)) {

            $currentUser = $this->User->find('first', array(
                'conditions' => array('username' => $this->data['User']['username'])
                )
            );

            $response = $this->User->create();
            $response['User']['returnCode'] = '1';

            if ($currentUser['User']['status'] != 0) {
                
                $response['User']['errorMsg'] = 'Account is inactive. This  may be because you requested reset password.';
                return json_encode($response);
            } else if (!empty($currentUser)
                    && $currentUser['User']['password'] == $this->data['User']['password']) {

                $this->Auth->login($this->data);
                $this->Session->write('user', $currentUser);
                
                if ($currentUser['User']['role'] == "artist") {
                    $this->loadModel('Band');
                    $userBand = $this->Band->find('all', array(
                        'joins' => array(array(
                            'table' => 'band_members',
                            'alias' => 'bandMember',
                            'type' => 'inner',
                            'conditions'=> 'bandMember.band_id= Band.id')
                    )));
                    $this->Session->write('bands', $userBand);
                    
                }
                
                $response['User']['returnCode'] = '0';
                return json_encode($response);
            } else {

                $this->Session->setFlash('Incorrect User/Password.');
                $response = $this->User->create();
                
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

    
    /*
     * Sends an email to the salesSupport team, requesting to change role to artist.
     */
    function registerAsArtist() {
        
        //TODO : Temp code for seamless registration as artist
        $currentUser = $this->Session->read('user');
        $currentUser ['User']['role'] = 'artist';
        $this->User->save($currentUser);
        
        $emailOption = Configure::read('emailOptions');
        
        $this->Email->to = Configure::read('salesSupportEmailId');
        $this->Email->subject = 'Bluecaffeine.com Artist Request received';
        $this->Email->smtpOptions = $emailOption;
        $this->Email->delivery = 'smtp';
        $this->Email->template = 'artist_request';
        $this->Email->sendAs = 'html';
        $this->Email->from = $emailOption['username'];
        $this->Email->send();
        
        $this->autoRender = false;
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
                $existUser['User']['status'] = '0';
                $existUser['User']['verificationCode'] = '';
                $this->User->save($existUser);
                $this->Auth->login($existUser);
                
                return $this->redirect('/');
            }
        }
    }

    function users() {
        
    }
    
    function userprofile(){
        
        if ($this->data) {
            
            $userDetail = $this->User->save($this->data);

            if ($userDetail) {
                $this->Session->write('user', $userDetail);
                $this->Session->setFlash('Saved.');
            } else {
                $this->Session->setFlash('Error while saving profile information');
            }
        }
    }

    function editProfileImage(){
        return $this->render('editProfileImage', 'ajax');
    }
    
    function showUploadForm() {
        if (!empty($this->data)) {
            $user = $this->Session->read('user');
            $uploaded = $this->JqImgcrop->uploadImage($this->data['User']['image']
                , 'content/band/upload', 'user_' . $user['User']['id']);
            $this->set('uploaded', $uploaded);
            $this->render('showUploadForm', 'ajax');
        }
    }
    
    
    function cropImage() {

        $imageName = $this->data['User']['imagePath'];
        $imageName = substr($imageName, strrpos($imageName, DS));

        $this->JqImgcrop->cropImage(400, $this->data['User']['x1']
            , $this->data['User']['y1'], $this->data['User']['x2']
            , $this->data['User']['y2'], $this->data['User']['w']
            , $this->data['User']['h'], 'content/band/thumbnail/' . $imageName
            , 'content/band/upload/' . $imageName);

        $this->set('uploadedImage', '/content/band/thumbnail/' . $imageName);
        $this->render('imageUpdated', 'ajax');
    }
    
    function forgot() {
        
    }
}
?>
