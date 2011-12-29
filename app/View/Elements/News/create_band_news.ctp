<?php
echo $this->Form->create('BandNews'
        , array('id' => 'newBandNewsForm'
    , 'url' => array('controller' => 'BandNews'
        , 'action' => 'createBandNews')));

$bandDetails = $this->Session->read('band');
?>
<fieldset>
    <?php
    echo $this->Form->input('id');
    echo $this->Form->input('newsurl', array('style' => 'margin-bottom: 6px;', 'label'=>'News URL'
        , 'onchange'=>'getNewsDetailsFromUrl()'));
    echo $this->Form->input('title', array('style' => 'margin-bottom: 6px;'));
    ?>
    <div class="input text required"><label for="BandNewsDescription">News Content</label>
    <?php
    echo $this->Form->textarea('description', array('rows' => '6', 'style' => 'margin-bottom: 6px;', 'label'=>'News URL')  );
    echo $this->Form->input('band_id', array('type' => 'hidden'
        , 'value' => $bandDetails['Band']['id']));
    ?>
    <input type="button" id="addNews" value="Save" style="width:60px; float: right; margin: 6px 14px 0 0;"/>

</fieldset>
<?php
echo $this->Form->end();
echo $this->Js->writeBuffer(array('inline' => 'true'));
?>
