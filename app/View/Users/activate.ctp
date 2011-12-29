<?php
echo $this->Form->create('User'
        , array('url' =>
    array('controller' => 'Users', 'action' => 'resetPasswd')
    , 'style' => 'width: 275px;'));
?>
<div class="error-message">
    <?php
    if (isset($resetPasswdStatus)) {
        echo $resetPasswdStatus;
    }
    ?>
</div>
<?php
if (isset($passwdresetUser)) {
    ?>

    <fieldset>
        <?php
        echo $this->Form->input('id', array('value' => $passwdresetUser['User']['id']));
        echo $this->Form->input('verificationCode', array('type'=>'hidden', 'value' => $passwdresetUser['User']['verificationCode']));
        echo $this->Form->input('password');
        echo $this->Form->input('confirm_password', array('type' => 'password'));
        ?>
        <div style = "clear: both;"></div>
        <fieldset>
            <input id = "registerButton" type = "submit" value = "Change Password" style = "width:115px; float: right; margin-top: 6px;"/>
        </fieldset>
    </fieldset>
    <?php $this->Form->end();
}
?>
