<?php
echo $this->Form->create('User', array('id' => 'registerForm'
    , 'url' => array('action' => 'register')
    , 'class' => 'bubbleForm'));
?>
<fieldset id="loginFormbody" >
    An email is send to your email account for email verification. Please follow the instruction in the email to activate you account.
</fieldset>
<div style="text-align: left;">
    <a href="#" style="color: white; " onclick="$('#loginFormWrapper').show(); $('#registrationFormWrapper').hide(); ">
        Already a member?
    </a>
</div>
<?php echo $this->Form->end(); ?>

