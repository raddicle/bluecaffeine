<?php

$featuredBand = Configure::read('featuredBand');
echo $this->Html->image('/content/band/thumbnail/band_' . $featuredBand['Band']['id'] . '.jpg', array('url' => array('controller' => 'Band',
        'action' => 'view', $featuredBand['Band']['id']), 'style' => 'margin: 6px 0px 6px 0px;'));
?>
<?php echo $featuredBand['Band']['bandName']; ?>
