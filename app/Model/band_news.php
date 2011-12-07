<?php

class BandNews extends AppModel {

    var $name = 'BandNews';
    var $belongsTo = 'Band';
    var $validate = array(
        'newsurl' => array(
            'message' => 'News URL must be entered.',
            'rule' => 'notEmpty'
        ), 'title' => array(
            'message' => 'News title must be entered.',
            'rule' => 'notEmpty'
        ), 'description' => array(
            'message' => 'News Description must be entered.',
            'rule' => 'notEmpty'
        )
    );

}

?>
