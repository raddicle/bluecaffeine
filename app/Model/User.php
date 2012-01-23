<?php

class User extends AppModel {

    var $name = 'User';
    var $validate = array(
        'password' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Password must be entered.',
                'allowEmpty' => false,
                'required' => true,
                 'on' => 'create'
            ),
            'minLength' => array(
                'rule' => array('minLength', 4),
                'message' => "Passwords must be at least 4 characters long"
            )
        ),
        'confirm_password' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Password and Password Confirmation must be supplied when setting the password',
                'allowEmpty' => false,
                'on' => 'create'
            )
        ),
        'first_name' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'First name must be entered.',
                'allowEmpty' => false,
                'on' => 'create'
            ),
        ),
        'last_name' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Last name must be entered.',
                'allowEmpty' => false,
                'on' => 'create'
            ),
        ),
        'username' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'User Name must be entered.',
                'allowEmpty' => false,
                'on' => 'create'
            ),
            'email' => array(
                'rule' => 'email',
                'message' => 'Please provide a valid email address.'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'This User is already created.'
            )
        )
    );

}

?>