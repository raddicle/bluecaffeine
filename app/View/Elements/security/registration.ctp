<style>
    form div {
        margin: 0 0 0 0;
        padding: 0px;
    }

    form fieldset label {
        float: left;
        padding: 0;
        text-align: left;
    }
</style>

<script>
    $(function() {
        $('#registerSubmitButton').die('click')
        .live('click', function (){
            $('#registerForm').ajaxSubmit({
                success: function (responseText, reponseCode) {
                    $('#registerBox').html(responseText);    
                    
                    registerButton = $('#registerButton');
                    registerBox = $('#registerBox');
                    registerForm = $('#registerForm');
        
                    registerButton.removeAttr('href');
                    registerButton.mouseup(function(login) {
                        registerBox.toggle();
                        registerButton.toggleClass('active');
                        $('#UserFirstName').focus();
                    });
                    registerForm.mouseup(function() { 
                        return false;
                    });
        
                    $(this).mouseup(function(item) {
                        if(!($(item.target).parent('#loginButton').length > 0)) {
                            loginButton.removeClass('active');
                            loginBox.hide();
                        }
                        if(!($(item.target).parent('#registerButton').length > 0)) {
                            registerButton.removeClass('active');
                            registerBox.hide();
                        }
                    });
                },
                error:function (XMLHttpRequest, textStatus, errorThrown) {
                    alert("error" + errorThrown + "    " + textStatus);
                }
            });
 
        });
    });    
</script>

<?php
echo $this->Form->create('User', array('id' => 'registerForm'
    , 'url' => array('action' => 'register')
    , 'class' => 'menuButtonForm'));
?>
<fieldset id="body" >
    <?php
    echo $this->Form->input('first_name', array('style' => "text-align: left"));
    echo $this->Form->input('last_name');
    echo $this->Form->input('username', array('label' => 'E-Mail'));
    echo $this->Form->input('password');
    echo $this->Form->input('confirm_password', array('type' => 'password'));
    ?>
    <input id="registerSubmitButton" type="button" value="Register" style="width:75px; float: right; margin-top: 6px;"/>
</fieldset>
<?php
echo $this->Form->end();
?>
