<?php
echo $this->Form->create('User'
        , array('url' =>
    array('controller' => 'Users', 'action' => 'emailPasswdLink')
    , 'style' => 'width: 275px;'));
?>
<fieldset>
    <div class="error-message" style="text-align: left"></div>
    <?php
    echo $this->Form->input('username', array('label' => 'E-Mail'));
    echo $this->Form->input('Submit', array('type' => 'button', 'label' => false));
    ?>
</fieldset>
<?php $this->Form->end(); ?>
<div class="error-message">
<?php if (isset($passwdResetRequestStatus)) {echo $passwdResetRequestStatus;} ?>
</div>