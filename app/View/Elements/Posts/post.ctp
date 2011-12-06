<script>

$(function (){
    $( '#postContent' ).ckeditor();
});

</script>
<?php
echo $this->Form->create('Post'
    , array('id' => 'newPostForm'
    , 'url' => array('controller' => 'Posts'
        , 'action' => 'post'
        , 'onSubmit' => '$("#PostBody").val(CKEDITOR.instances.PostBody.getData());')));
?>
<fieldset>
    <?php
    echo $this->Form->input('id');
    echo $this->Form->input('title', array('style' => 'margin-bottom: 6px;'));
    echo $this->Form->textarea('body', array('class' => 'ckeditor', 'id'=>'postContent'));
    echo $this->Form->input('band_id', array('type' => 'hidden', 'value' => $this->Session->read('bandId')));
    ?>
    <input type="button" id="addPost" value="Save" style="width:60px; float: right; margin-top: 6px;"/>

</fieldset>
<?php
echo $this->Form->end();
echo $this->Js->writeBuffer(array('inline' => 'true'));
?>
