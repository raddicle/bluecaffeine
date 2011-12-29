<?php

class Message extends AppModel {

    var $name = 'Message';
    var $validate = array('subject' => array('notEmpty' => array('rule' => array('notEmpty'),
                'message' => 'Subject must be entered.',
                'allowEmpty' => false,
                'required' => true
            )
        ),
        'msg' => array('notEmpty' => array('rule' => array('notEmpty'),
                'message' => 'Message must be entered.',
                'allowEmpty' => false,
                'required' => true
            )
        ),
        'to' => array('notEmpty' => array('rule' => array('notEmpty'),
                'message' => 'To Email address must be entered.',
                'allowEmpty' => false,
                'required' => true
            )
        )
    );

}

?>