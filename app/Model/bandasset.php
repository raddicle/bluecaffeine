<?php

class BandAsset extends AppModel {

    var $name = 'Bandasset';
    
    var $validate = array('file_name' => array('notEmpty' => array('rule' => array('notEmpty'),
                'message' => 'Name must be entered.',
                'allowEmpty' => false,
                'required' => true
            )
        ),
        'genre' => array('notEmpty' => array('rule' => array('notEmpty'),
                'message' => 'Genre must be entered.',
                'allowEmpty' => false,
                'required' => true
            )
        )
    );

    
}

?>