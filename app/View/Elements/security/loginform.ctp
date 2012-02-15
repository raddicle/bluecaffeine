<script>
    $(function() {
        $('#loginSubmitButton').die('click')
        .live('click', function (){
            $('#loginForm').ajaxSubmit({
                success: function (responseText, reponseCode) {
                    var response = $.parseJSON(responseText);
                    if(response.User.returnCode == 0) {
                        $(location).attr('href',"<?php echo $this->Html->url('/'); ?>");
                    } else {
                        $('#loginMessage').html(response.User.errorMsg);
                    }
                
                },
                error:function (XMLHttpRequest, textStatus, errorThrown) {
                    alert("error" + errorThrown + "    " + textStatus);
                }
            });
 
        });
    });
</script>
<?php
echo $this->Form->create('User', array('id' => 'loginForm'
    , 'url' => array('action' => 'login')));
?>
<fieldset>
    <?php
    echo $this->Form->input('username', array('label' => 'E-Mail'));
    echo $this->Form->input('password');
    ?>
    <label for="checkbox" style="margin-top: 10px; color: #444444;">
        <input type="checkbox" id="remember_me" style="vertical-align: bottom; margin-right: 6px;"/>Remember me
    </label>
    <input id="loginSubmitButton" value="Login" type="button" style="width:60px; float: right; margin-top: 6px;"/>

    <div id="loginMessage" class="error-message" style="text-align: left"></div>
</fieldset>

<?php
echo $this->Html->link('Forgot your password?', array('controller' => 'Users', 'action' => 'forgot'), array('style' => 'color: #444444;'));
echo $this->Form->end();
?>
