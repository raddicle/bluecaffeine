<?php

/**
 * Model class representing band.
 */
class Band extends AppModel {

    var $name = "Band";
    var $hasMany = array('BandMember', 'Post', 'Bandasset', 'BandNews');
    var $hasAndBelongsToMany = array(
        'User' => array('with' => 'BandMember'));
    var $validate = array('bandName' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Band Name must be entered.',
                'allowEmpty' => false,
                'required' => true
            )
        ),
        'genre' => array('notEmpty' => array('rule' => array('notEmpty'),
                'message' => 'Genre must be entered.',
                'allowEmpty' => false,
                'required' => true
            )
        ),
        'email' => array('notEmpty' => array('rule' => array('notEmpty'),
                'message' => 'Email must be entered.',
                'allowEmpty' => false,
                'required' => true
            ),
            'email' => array(
                'rule' => 'email',
                'message' => 'Please provide a valid email address.'
            )
        )
    );

}

?>
