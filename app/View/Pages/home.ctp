<script>
    $(function() {
        $('#addemailToNotify') 
        .click(function(event){ 
            event.preventDefault();
            event.stopPropagation();
            addPost();
        }); 
    });

    function addPost(){
        $("#newPreStartForm").ajaxSubmit({ 
            success: function(responseText, responseCode) { 
                document.getElementById("messageArea").innerHTML = 
                    "Thanks for registering with us. We will inform you when we open for business.";
            } 
        }); 
        return false; 
    }

</script>

<div class="backImage" style="text-align: center;">
    <?php
    echo $this->Html->image('home.jpg', array('style' => ' margin-top: 10px'));
    ?>
</div>
<div style="width: 300px; font-size: 24px; font-weight: bold; color: #fff; margin-left: auto; margin-right: auto; text-align: center">
    new music records make them and then break some
</div>

<!--<div class="ribbon" style="background: #fff; width: 400px; margin: 300px; padding: 10px;">
    <div id="messageArea">
    This is going to be a place for musicians and those who love music. Please leave your E-Mail address for notification.
    
<?php
echo $this->Form->create('Prestartemail'
    , array('id' => 'newPreStartForm'
    , 'url' => array('controller' => 'Prestartemail'
        , 'action' => 'acceptEmail'
    )));
echo $this->Form->input('email', array('div' => false));
?>
    <button type="button" id="addemailToNotify" 
        margin-left: 10px;'>
      Register
    </button>
<?php
echo $this->Form->end();
?>
        </div>-->
